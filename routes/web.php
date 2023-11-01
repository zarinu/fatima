<?php

use App\Http\Controllers\Admin\ArtisanController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Web\CartController;
use App\Http\Controllers\Web\CoursesController;
use App\Http\Controllers\Web\Panel\LessonsController;
use App\Http\Controllers\Web\Panel\PaymentsController;
use App\Http\Controllers\Web\Panel\UserPanelController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

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
        Route::post('/discount', [CartController::class, 'applyDiscountCode'])->name('cart.discount');
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

        Route::group(['prefix' => 'payments'], function () {
            Route::get('create', [PaymentsController::class, 'create']);
            Route::get('verify', [PaymentsController::class, 'verify']);
        });
    });
});

// Admin
Route::group(['middleware' => ['auth', 'admin'], 'prefix' => 'admin'], function () {
    // Dashboard
    Route::get('/', [DashboardController::class, 'index']);

    // Users Management
    Route::prefix('users')->controller(UsersController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('/create', 'create');
        Route::post('/store', 'store');
        Route::prefix('{user}')->group(function() {
            Route::get('/edit', 'edit');
            Route::post('/update', 'update');
            Route::get('/delete', 'delete');
        });
    });

    // Courses Management
    Route::prefix('courses')->group(function () {

        // Courses
        Route::controller(App\Http\Controllers\Admin\CoursesController::class)->group(function () {
            Route::get('/', 'index');
            Route::get('/create', 'create');
            Route::post('/store', 'store');
            Route::prefix('{course}')->group(function() {
                Route::get('/edit', 'edit');
                Route::post('/update', 'update');
                Route::get('/delete', 'delete');
            });
        });

        // Chapters
        Route::controller(App\Http\Controllers\Admin\ChaptersController::class)
            ->prefix('{course}/chapters')->group(function () {

            Route::get('/', 'index');
            Route::get('/create', 'create');
            Route::post('/store', 'store');
            Route::prefix('{chapter}')->group(function() {
                Route::get('/edit', 'edit');
                Route::post('/update', 'update');
                Route::get('/delete', 'delete');
            });
        });

        // Lessons
        Route::controller(App\Http\Controllers\Admin\LessonsController::class)
            ->prefix('{course}/lessons')->group(function () {

            Route::get('/', 'index');
            Route::get('/create', 'create');
            Route::post('/store', 'store');
            Route::prefix('{lesson}')->group(function() {
                Route::get('/edit', 'edit');
                Route::post('/update', 'update');
                Route::get('/delete', 'delete');
            });
        });
    });

    // Orders Management
    Route::prefix('orders')->controller(\App\Http\Controllers\Admin\OrdersController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('/create', 'create');
        Route::post('/store', 'store');
        Route::prefix('{order}')->group(function() {
            Route::get('/edit', 'edit');
            Route::post('/update', 'update');
            Route::get('/delete', 'delete');
        });
    });

    // Payments Management
    Route::prefix('payments')->controller(\App\Http\Controllers\Admin\PaymentsController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('/create', 'create');
        Route::post('/store', 'store');
        Route::prefix('{payment}')->group(function() {
            Route::get('/edit', 'edit');
            Route::post('/update', 'update');
            Route::get('/delete', 'delete');
        });
    });

    // Discounts Management
    Route::prefix('discounts')->controller(\App\Http\Controllers\Admin\DiscountsController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('/create', 'create');
        Route::post('/store', 'store');
        Route::prefix('{discount}')->group(function() {
            Route::get('/edit', 'edit');
            Route::post('/update', 'update');
            Route::get('/delete', 'delete');
        });
    });

    // Php Artisan Commands
    Route::get('/artisan/{param}', [ArtisanController::class, 'index']);
});

//Route::middleware('auth')->group(function () {
//    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
//});