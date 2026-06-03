<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProfileTController;
use App\Http\Controllers\KursAController;
use App\Http\Controllers\ItemAController;

Route::get('/', [MainController::class, 'home'])->name('home');
Route::get('/logout', function () {
    Auth::logout();
    return redirect()->route('home');
})->name('logout');

Route::get('/about', [MainController::class, 'about'])->name('about');
Route::get('/kurs', [MainController::class, 'kurs'])->name('kurs');
Route::get('/show/{id}', [MainController::class, 'show'])->name('show');
Route::get('/kontact', [MainController::class, 'kontact'])->name('kontact');
Route::get('/teacher', [MainController::class, 'teacher'])->name('teacher');

Route::get('/polcon', [MainController::class, 'polcon'])->name('polcon');

Route::get('/review', [MainController::class, 'review'])->name('review');

Route::get('/register', [MainController::class, 'create'])->name('register');
Route::post('register', [MainController::class, 'storeRegister'])->name('storeRegister');
Route::get('/login', [MainController::class, 'login'])->name('login');
Route::post('login', [MainController::class, 'storeLogin'])->name('storeLogin');

Route::middleware(['auth'])->prefix('user')->group(function () {
    Route::post('/reviews/send', [MainController::class, 'sendReview'])->name('reviews.send');
});
Route::middleware(['auth'])->prefix('teacher')->group(function (){
    Route::get('/profileT', [ProfileTController::class, 'show'])->name('profileT');
    Route::get('/profileT/edit', [ProfileTController::class, 'edit'])->name('profileT.edit');
    Route::put('/profileT/update', [ProfileTController::class, 'update'])->name('profileT.update');
});

Route::get('/schedule', [MainController::class, 'schedule'])->name('schedule');
Route::get('/zapiz', [MainController::class, 'zapiz'])->name('zapiz');
Route::post('zapiz', [MainController::class, 'storeZapiz'])->name('storeZapiz');

Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/', [MainController::class, 'admin'])->name('admin.home.admin');

    Route::resource('item', ItemAController::class)->parameters([
        'item' => 'items'
    ])->names([
                'index' => 'admin.item.itemA',
                'create' => 'admin.item.itemACreate',
                'store' => 'admin.item.store',
                'edit' => 'admin.item.itemAEdit',
                'update' => 'admin.item.update',
                'destroy' => 'admin.item.destroy',
            ]);

    Route::resource('kurs', KursAController::class)->parameters([
        'kurs' => 'kurs'
    ])->names([
                'index' => 'admin.kurs.kursA',
                'create' => 'admin.kurs.kursACreate',
                'store' => 'admin.kurs.store',
                'edit' => 'admin.kurs.kursAEdit',
                'update' => 'admin.kurs.update',
                'destroy' => 'admin.kurs.destroy',
            ]);

    Route::get('tutor', [MainController::class, 'tutorA'])->name('admin.tutor.tutorA');
    Route::get('tutor/status/{id}', [MainController::class, 'tutorAStatus'])->name('admin.tutor.tutorAStatus');
    Route::post('tutor/{id}/update-status', [MainController::class, 'updateTutorStatus'])->name('admin.tutor.updateStatus');

    Route::get('schedule', [MainController::class, 'scheduleA'])->name('admin.schedule.scheduleA');
    Route::get('schedule/status/{id}', [MainController::class, 'scheduleAStatus'])->name('admin.schedule.scheduleAStatus');
    Route::post('schedule/{id}/update-status', [MainController::class, 'updateScheduleStatus'])->name('admin.schedule.updateStatus');

    Route::get('review', [MainController::class, 'reviewA'])->name('admin.review.reviewA');
    Route::get('review/status/{id}', [MainController::class, 'reviewAStatus'])->name('admin.review.reviewAStatus');
    Route::post('review/{id}/update-status', [MainController::class, 'updateReviewStatus'])->name('admin.review.updateStatus');

});