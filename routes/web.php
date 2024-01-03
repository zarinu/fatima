<?php

use App\Http\Controllers\Admin\ArtisanController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Web\CartController;
use App\Http\Controllers\Web\CommentsController;
use App\Http\Controllers\Web\CoursesController;
use App\Http\Controllers\Web\Panel\LessonsController;
use App\Http\Controllers\Web\Panel\PaymentsController;
use App\Http\Controllers\Web\Panel\UserPanelController;
use App\Http\Controllers\Web\DirectLinksController;
use App\Http\Controllers\Web\TestController;
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
    // Common routes
    Route::get('/test/{method}', [TestController::class, 'main']);
    Route::get('/خرید-دوره-لباس-عروسک', [DirectLinksController::class, 'getBuyDollClothesCourse']);
    Route::post('/خرید-دوره-لباس-عروسک', [DirectLinksController::class, 'buyDollClothesCourse'])->name('direct_link');
    Route::post('/buy-directly/cart', [DirectLinksController::class, 'buyDollClothesCourseByCart'])->name('direct_link_cart');

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

    // Comments
    Route::group(['prefix' => 'comments'], function () {
        Route::post('/store', [CommentsController::class, 'store']);
        Route::get('/{comment}/like', [CommentsController::class, 'like']);
        Route::get('/{comment}/dislike', [CommentsController::class, 'dislike']);
    });

    // Panel
    Route::group(['middleware' => ['auth', 'verified'], 'prefix' => 'panel'], function () {
//        Route::get('/', [UserPanelController::class, 'dashboard'])->name('dashboard');
        Route::get('/', [CoursesController::class, 'myCourses'])->name('courses.panel');
        Route::get('/courses', [CoursesController::class, 'myCourses']);
//        Route::get('/profile', [UserPanelController::class, 'editProfile'])->name('profile.edit');
//        Route::post('/profile', [UserPanelController::class, 'updateProfile'])->name('profile.update');

        Route::prefix('/courses/{course}/lessons/{lesson}')->group(function () {
            Route::get('/', [LessonsController::class, 'show'])->name('lessons.show');
            Route::get('/download', [LessonsController::class, 'download'])->name('lessons.download');
            Route::get('/toggle-complete/{status}', [LessonsController::class, 'toggleComplete']);
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
        Route::get('/grid', 'grid')->name('users.grid');
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

    // Comments Management
    Route::prefix('comments')->controller(\App\Http\Controllers\Admin\CommentsController::class)->group(function () {
        Route::get('/', 'index');
        Route::prefix('{comment}')->group(function() {
            Route::get('/activate', 'activate');
            Route::get('/inactivate', 'inactivate');
            Route::get('/edit', 'edit');
            Route::post('/update', 'update');
            Route::get('/delete', 'delete');
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

    // Users courses Management
    Route::prefix('users-courses')->controller(\App\Http\Controllers\Admin\UsersCoursesController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('/grid', 'grid')->name('user_courses.grid');
        Route::get('/create', 'create');
        Route::post('/store', 'store');
        Route::get('/{user_course}/delete', 'delete');
    });

    // Student Photos Management
    Route::prefix('student-photos')->controller(\App\Http\Controllers\Admin\StudentPhotosController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('/create', 'create');
        Route::post('/store', 'store');
        Route::get('/{student_photo}/delete', 'delete');
    });

    // Php Artisan Commands
    Route::get('/artisan/{param}', [ArtisanController::class, 'index']);
});

//Route::middleware('auth')->group(function () {
//    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
//});