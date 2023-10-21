<?php

use App\Http\Controllers\Web\CartController;
use App\Http\Controllers\Web\CoursesController;
use App\Http\Controllers\Web\Panel\LessonsController;
use App\Http\Controllers\Web\Panel\UserPanelController;
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

// Php Artisan Commands
Route::get('/artisan/{param}', function ($param) { Artisan::call($param); return 'done'; });

// Web
Route::group(['middleware' => ['web']], function () {
    // Auth
    require __DIR__.'/auth.php';

    // Home
    Route::view('/', 'web.home.index');

    // Courses - Web
    Route::group(['prefix' => 'courses'], function () {
        Route::get('/', [CoursesController::class, 'index'])->name('courses.index');
        Route::get('/{course}', [CoursesController::class, 'show'])->name('courses.show');
    });

    // Cart
    Route::group(['prefix' => 'cart'], function () {
        Route::get('/', [CartController::class, 'index'])->name('cart.index');
        Route::get('/{course}', [CartController::class, 'addItem'])->name('cart.add');
        Route::delete('/delete', [CartController::class, 'deleteItem'])->name('cart.delete');
    });

    // Panel
    Route::group(['middleware' => ['auth', 'verified'], 'prefix' => 'panel'], function () {
        Route::get('/', [UserPanelController::class, 'dashboard'])->name('dashboard');
//        Route::get('/profile', [UserPanelController::class, 'editProfile'])->name('profile.edit');
//        Route::post('/profile', [UserPanelController::class, 'updateProfile'])->name('profile.update');

        Route::prefix('courses')->group(function () {
            Route::get('/', [CoursesController::class, 'myCourses'])->name('courses.panel');
            Route::prefix('/{course}/lessons/{lesson}')->group(function () {
                Route::get('/', [LessonsController::class, 'show'])->name('lessons.show');
                Route::get('/download', [LessonsController::class, 'download'])->name('lessons.download');
                // Route::get('/toggle-complete', [LessonsController::class, 'toggleComplete']);
            });
        });

//        Route::group(['prefix' => 'payments'], function () {
//            Route::get('first-step', [PaymentsController::class, 'firstStep']);
//        });
    });
});


//Route::middleware('auth')->group(function () {
//    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
//});