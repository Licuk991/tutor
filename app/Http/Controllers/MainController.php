<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\kurs;
use App\Models\schedules;
use App\Models\classes;
use App\Models\items;
use App\Models\reviews;
use App\Models\tutors_details;
use App\Models\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;


class MainController extends Controller
{
    public function home()
    {
        $slides = [
            'slider1.jpeg',
            'slider2.jpeg',
            'slider3.jpeg'
        ];

        $teachers = tutors_details::where('status', 'принять')->get();
        return view('home', compact('slides', 'teachers'));
    }
    public function logout()
    {
        return view('logout');
    }

    public function kontact()
    {
        return view('kontact');
    }
    public function about()
    {
        return view('about');
    }
    public function polcon()
    {
        return view('polcon');
    }

    public function kurs(Request $request)
    {
        $items = items::all();
        $classes = classes::all();

        $selectedItem = $request->input('items', 'VSE');
        $selectedClasses = $request->input('class', 'Vse1');

        $query = kurs::with(['KursItem', 'KursClasses']);

        $zag = '';
        if ($selectedItem == 'VSE' && $selectedClasses == 'Vse1') {
            $zag = 'Все курсы, все классы';
        } elseif ($selectedItem == 'VSE') {
            // Ищем по внешнему ключу classes_id, а не по id курса
            $query->where('classes_id', $selectedClasses);
            $classTitle = classes::find($selectedClasses)?->number ?? '';
            $zag = 'Все курсы класса ' . $classTitle;
        } elseif ($selectedClasses == 'Vse1') {
            // Ищем по внешнему ключу item_id, а не по id курса
            $query->where('item_id', $selectedItem);
            $itemTitle = items::find($selectedItem)?->name_t ?? '';
            $zag = 'Все классы курса ' . $itemTitle;
        } else {
            // Ищем по обоим внешним ключам
            $query->where('item_id', $selectedItem)->where('classes_id', $selectedClasses);
            $itemTitle = items::find($selectedItem)?->name_t ?? '';
            $classTitle = classes::find($selectedClasses)?->number ?? '';
            $zag = 'Курс ' . $itemTitle . ' класс ' . $classTitle;
        }

        $kursy = $query->get();

        return view('kurs', compact('items', 'classes', 'kursy', 'zag', 'selectedItem', 'selectedClasses'));
    }

    public function show($id)
    {
        $kurs = kurs::findOrFail($id);
        return view('show', ['kurs' => $kurs]);
    }

    public function review()
    {
        $userId = auth()->id();
        $reviews = reviews::where('status', 'принять')->with('ReviewUser')->get();

        $completedSchedules = collect();
        $existingReviews = [];

        if ($userId) {
            $completedSchedules = schedules::where('user_id', $userId)
                ->where('status', 'курс завершен')
                ->get();

            $existingReviews = reviews::where('user_id', $userId)
                ->pluck('schedule_id')
                ->toArray();
        }

        return view('review', compact('completedSchedules', 'reviews', 'existingReviews'));
    }


    public function sendReview(Request $request)
    {
        $validated = $request->validate([
            'schedule_id' => 'required|exists:schedules,id',
            'rang' => 'required|integer|min:1|max:5',
            'text' => 'required|string|min:5',
        ]);

        $schedule = schedules::findOrFail($validated['schedule_id']);

        // Проверка, что курс завершён и принадлежит пользователю
        if ($schedule->status !== 'курс завершен' || $schedule->user_id !== auth()->id()) {
            return back()->with('error', 'Вы не можете оставить отзыв по этому курсу.');
        }

        // Проверка, что отзыв еще не оставлен
        $alreadyExist = reviews::where('user_id', auth()->id())->where('schedule_id', $schedule->id)->exists();

        if ($alreadyExist) {
            return back()->with('error', 'Вы уже оставляли отзыв на это занятие.');
        }

        // Создаём отзыв с статусом 'pending'
        reviews::create([
            'user_id' => auth()->id(),
            'schedule_id' => $schedule->id,
            'rang' => $validated['rang'],
            'text' => $validated['text'],
            'status' => 'новая', // статус на модерацию
        ]);

        return back()->with('success', 'Ваш отзыв отправлен на рассмотрение.');
    }


    public function teacher()
    {
        // Получаем только одобренных репетиторов
        $teachers = tutors_details::where('status', 'принять')->get();

        return view('teacher', compact('teachers'));
    }

    public function register()
    {
        return view('register');
    }
    public function login()
    {
        return view('login');
    }
    public function create()
    {
        // Получаем все предметы из базы данных
        $items = items::all();

        // Передаем переменную $items в view
        return view('register', compact('items'));
    }


    public function storeRegister(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'FIO' => 'required|regex:/^[А-Яа-яЁё\s]+$/u',
            'login' => 'required|regex:/^[a-zA-Z0-9]+$/',
            'password' => 'required|min:6',
            'email' => 'required|email|unique:users,email',
            // Добавляем валидацию для учителя
            'item_id' => 'required_if:role,teacher',
            'experience' => 'nullable|numeric|min:0|required_if:role,teacher',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,jfif|max:2048|required_if:role,teacher',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            DB::beginTransaction();

            $user = User::create([
                'FIO' => $request->FIO,
                'login' => $request->login,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role,
            ]);

            if ($request->role === 'teacher') {
                $photoPath = null;

                // Проверяем, загружен ли файл

                if ($request->hasFile('photo')) {
                    $file = $request->file('photo');

                    // Генерируем уникальное имя, чтобы файлы не перезаписывали друг друга
                    $fileName = time() . '_' . $file->getClientOriginalName();

                    // Путь к папке public/assets/img/teacher
                    $destinationPath = public_path('assets/img/teacher');

                    // Перемещаем файл
                    $file->move($destinationPath, $fileName);

                    // Сохраняем в БД путь относительно папки public
                    $photoPath = 'teacher/' . $fileName;
                }


                $user->UserTurot()->create([
                    'user_id' => $user->id,
                    'item_id' => $request->item_id,
                    'experience' => $request->experience,
                    'photo' => $photoPath, // Сохраняем путь (строку)
                ]);
            }

            DB::commit();
            return redirect()->back()->withSuccess('Пользователь успешно зарегистрировался');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Ошибка при регистрации: ' . $e->getMessage()])->withInput();
        }
    }
    public function storeLogin(Request $request)
    {
        $credentials = $request->validate([
            'login' => 'required|string',
            'password' => 'required|string',
        ]);

        if (Auth::attempt(['login' => $credentials['login'], 'password' => $credentials['password']])) {

            $user = Auth::user();

            if ($user->role === 'teacher') {
                $tutor_details = tutors_details::where('user_id', $user->id)->first();

                if (!$tutor_details || in_array($tutor_details->status, ['новая', 'отклонена'])) {
                    Auth::logout();

                    return redirect()->route('login')->withErrors(['login' => 'Ваша заявка на роль учителя находится на рассмотрении или была отклонена. Пожалуйста дождитель одобреня'])->withInput();
                }
            }

            if ($user->role === 'admin') {
                return redirect()->route('admin.home.admin')->with('success', 'Вы зашли как администратор');
            } elseif ($user->role === 'teacher') {
                return redirect()->route('profileT')->with('success', 'Вы зашли как учитель');
            } elseif ($user->role === 'user') {
                return redirect()->route('schedule')->with('success', 'Вы зашли как пользователь');
            }

            return redirect()->route('login');
        }

        return redirect()->back()->withErrors(['login' => 'Неверный логин или пароль'])->withInput();
    }

    public function profileT()
    {
        return view('profileT');
    }

    public function schedule()
    {
        $userId = Auth::id();
        $schedules = schedules::with(['ScheItem', 'ScheClasses']) // ЗАГРУЖАЕМ СВЯЗИ СРАЗУ
            ->where('user_id', $userId)
            ->orderBy('date', 'desc')
            ->get();

        return view('schedule', compact('schedules'));
    }
    public function zapiz()
    {
        $items = items::all();
        $classes = classes::all();
        return view('zapiz', compact('items', 'classes'));
    }

    public function storeZapiz(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'item_id' => 'required|exists:items,id',
            'class_id' => 'required|exists:classes,id', // Это имя из HTML формы
            'date' => 'required|date|after:today',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = Auth::user();

        schedules::create([
            'user_id' => $user->id,
            'item_id' => $request->item_id,
            'classes_id' => $request->class_id,
            'date' => $request->date,
        ]);

        return redirect()->back()->withSuccess('Заявка успешно добавлена');
    }

    public function admin()
    {
        return view('admin.home.admin');
    }
    public function tutorA()
    {
        $applications = tutors_details::orderBy('id', 'DESC')->get();
        return view('admin.tutor.tutorA', compact('applications'));
    }

    public function tutorAStatus($id)
    {
        $application = tutors_details::findOrFail($id);
        return view('admin.tutor.tutorAStatus', compact('application'));
    }

    public function updateTutorStatus(Request $request, $id)
    {
        $application = tutors_details::findOrFail($id);
        $application->status = $request->input('status');
        $application->save();

        return redirect()->route('admin.tutor.tutorA')->with('success', 'Статус успешно обновлен');
    }

    public function scheduleA()
    {
        $schedules = schedules::orderBy('id', 'DESC')->get();
        return view('admin.schedule.scheduleA', compact('schedules'));
    }

    public function scheduleAStatus($id)
    {
        $schedules = schedules::findOrFail($id);
        return view('admin.schedule.scheduleAStatus', compact('schedules'));
    }

    public function updateScheduleStatus(Request $request, $id)
    {
        $schedules = schedules::findOrFail($id);
        $schedules->status = $request->input('status');
        $schedules->save();

        return redirect()->route('admin.schedule.scheduleA')->with('success', 'Статус успешно обновлен');
    }

    public function reviewA()
    {
        $reviews = reviews::orderBy('id', 'DESC')->get();
        return view('admin.review.reviewA', compact('reviews'));
    }

    public function reviewAStatus($id)
    {
        $reviews = reviews::findOrFail($id);
        return view('admin.review.reviewAStatus', compact('reviews'));
    }

    public function updateReviewStatus(Request $request, $id)
    {
        $reviews = reviews::findOrFail($id);
        $reviews->status = $request->input('status');
        $reviews->save();

        return redirect()->route('admin.review.reviewA')->with('success', 'Статус успешно обновлен');
    }



}
