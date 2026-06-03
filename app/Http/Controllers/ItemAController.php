<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\items;

class ItemAController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = items::orderBy('id', 'desc')->get();
        return view('admin\item\itemA', [
            'items' => $items
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.item.itemACreate');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name_t' => 'required|string|max:255',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $path = null;

        if ($request->hasFile('foto')) {
            // 1. Получаем расширение файла (png, jpg и т.д.)
            $extension = $request->file('foto')->getClientOriginalExtension();

            // 2. Генерируем уникальное имя файла (например, 65abc123.jpg)
            $fileName = time() . '_' . uniqid() . '.' . $extension;

            // 3. Определяем путь назначения: public/assets/img/item/
            // public_path() указывает на корень вашей папки public
            $destinationPath = public_path('assets/img/item');

            // 4. Перемещаем файл в папку
            $request->file('foto')->move($destinationPath, $fileName);

            // 5. Сохраняем в базу относительный путь для удобства вывода
            $path = 'item/' . $fileName;
        }

        // Убедитесь, что название модели с большой буквы: Item
        items::create([
            'name_t' => $request->name_t,
            'foto' => $path,
        ]);

        return redirect()->route('admin.item.itemA')->with('success', 'Предмет создан!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(items $items)
    {
        return view('admin.item.itemAEdit', [
            'item' => $items
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, items $items)
    {
        // Валидация
        $request->validate([
            'name_t' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Обновляем название
        $items->name_t = $request->input('name_t');

        // Обработка загрузки нового изображения
        if ($request->hasFile('foto')) {
            // Удаляем старое изображение, если оно есть
            if ($items->foto && file_exists(public_path($items->foto))) {
                unlink(public_path($items->foto));
            }

            // Загрузка нового изображения
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->move(public_path('assets/img/item'), $filename);

            // Обновляем путь к файлу в базе
            $items->foto = 'item/' . $filename;
        }

        // Сохраняем изменения
        $items->save();

        // Перенаправление с сообщением об успехе
        return redirect()->route('admin.item.itemA')->with('success', 'Предмет успешно обновлён!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(items $items)
    {
        $items->delete();
        return redirect()->back()->withSuccess('Предмет был успешно удален!');
    }
}
