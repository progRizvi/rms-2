<?php

use App\Http\Controllers\Backend\ChangePassword;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\ForgetPasswordController;
use App\Http\Controllers\Backend\LoginController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\RestaurantRegistrationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::get("/", [HomeController::class, "index"])->name("home");
Route::get("/category-details/{slug}", [HomeController::class, "categoryDetails"])->name("category.details");
Route::get("/post-details/{slug}", [HomeController::class, "postDetails"])->name("post.details");
Route::get("/post/search", [HomeController::class, "postSearch"])->name("post.search");
Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/login/post', [LoginController::class, 'loginPost'])->name('login.post');

// Forget pass
Route::get('/forget/password', [ForgetPasswordController::class, 'forgetPassword'])->name('admin.forget.password');
Route::post('/forget/password/post', [ForgetPasswordController::class, 'forgetPasswordPost'])->name('admin.forget.password.post');
Route::get('/reset-password/{token}', [ForgetPasswordController::class, 'resetPassword'])->name('admin.reset.password');
Route::post('/reset-password/{token}', [ForgetPasswordController::class, 'resetPasswordPost'])->name('admin.reset.password.post');

// restaurant registration
Route::get('/restaurant/registration', [RestaurantRegistrationController::class, 'registration'])->name('restaurant.registration');

Route::post('/restaurant/registration/post', [RestaurantRegistrationController::class, 'doRegistration'])->name('restaurant.registration.post');

Route::group(["prefix" => "admin", 'middleware' => ['auth']], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::group(['prefix' => 'admin'], function () {
        Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
    });

    Route::group(['prefix' => 'users'], function () {
        Route::get('/', [UserController::class, 'list'])->name('user.list');
        Route::get('/view/{id}', [UserController::class, 'view'])->name('user.profile');
        Route::get('/create', [UserController::class, 'create'])->name('user.create');
        Route::post('/store', [UserController::class, 'store'])->name('user.store');
        Route::get('/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
        Route::put('/update/{id}', [UserController::class, 'update'])->name('user.update');
        Route::get('/block/{id}', [UserController::class, 'block'])->name('user.block');
        Route::get('/unblock/{id}', [UserController::class, 'unblock'])->name('user.unblock');
        Route::get('/change-password', [ChangePassword::class, 'changePassword'])->name('changePassword');
        Route::post('/change-password', [ChangePassword::class, 'changePasswordProcess'])->name('change.password.process');
    });

    Route::group(['prefix' => 'settings'], function () {
        Route::get('/', [SettingController::class, 'show'])->name('settings');
        Route::put('/update', [SettingController::class, 'settings'])->name('settings.update');
    });

    Route::group(['prefix' => 'roles'], function () {
        Route::get('/', [RoleController::class, 'index'])->name('role.list');
        Route::get('/create', [RoleController::class, 'create'])->name('role.create');
        Route::post('/store', [RoleController::class, 'store'])->name('role.store');
        Route::get('/edit/{id}', [RoleController::class, 'edit'])->name('role.edit');
        Route::post('/update/{id}', [RoleController::class, 'update'])->name('role.update');
        Route::get('/delete/{id}', [RoleController::class, 'delete'])->name('role.delete');
    });

    Route::resource("categories", CategoryController::class);
    Route::resource("posts", PostController::class);

});

Route::group(["prefix" => "restaurant", "middleware" => ["auth:restaurants"]], function () {
    Route::get('/', [RestaurantController::class, "dashboard"])->name("restaurant.dashboard");
    Route::get('/logout', [LoginController::class, 'logout'])->name('restaurant.logout');
    Route::resource("categories", CategoryController::class);

});
