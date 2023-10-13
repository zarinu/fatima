<?php

use App\Http\Controllers\CoursesController;
use App\Http\Controllers\PaymentsController;
//use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RcourCoursesControllerouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

require __DIR__.'/auth.php';

Route::get('/', function () {
    return view('main');
});

Route::prefix('courses')->group(function () {
    Route::get('/', [CoursesController::class, 'index'])->name('courses.index');
    Route::get('/{course}', [CoursesController::class, 'show'])->name('courses.show');
});

Route::middleware('auth')->prefix('panel')->group(function () {
    Route::prefix('courses')->group(function () {
        Route::get('/{course}/lessons/{lesson}', [CoursesController::class, 'show_lessons'])->name('lessons.show');
//        Route::get('/{course}/lessons/{lesson}/toggle-complete', [CoursesController::class, 'toggle_complete']);
    });

    Route::group(['prefix' => 'payments'], function () {
        Route::get('first_step', [PaymentsController::class, 'first_step']);
    });
});

Route::get('/artisan/{param}', function ($param) {
    Artisan::call($param);
});

//Route::middleware('auth')->group(function () {
//    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
//});
//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');