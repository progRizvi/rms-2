<?php

use App\Http\Controllers\Backend\ChangePassword;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\ForgetPasswordController;
use App\Http\Controllers\Backend\LoginController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\RestaurantRegistrationController;
use App\Http\Controllers\SslCommerzPaymentController;
use App\Http\Controllers\UserBookingController;
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
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::group(["as" => "frontend."], function () {
    Route::get("/restaurant/res/{slug}", [HomeController::class, "restaurantDetails"])->name("restaurant.details");
    Route::get("front/restaurant/res/food-details", [HomeController::class, "foodDetails"])->name("food.details");
});

Route::post('register-store', [CustomerController::class, 'store'])->name('register.store');

Route::post('user-customer-login', [CustomerController::class, 'customerDoLogin'])->name('userCustomer.login');

Route::get('user-customer-logout', [CustomerController::class, 'customerLogout'])->name('userCustomer.logout');

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

Route::get('cart', [CartController::class, 'cart'])->name('cart');
Route::post('add-to-cart/', [CartController::class, 'addToCart'])->name('add.to.cart');
Route::post('update-cart', [CartController::class, 'update'])->name('update.cart');
Route::delete('remove-from-cart', [CartController::class, 'remove'])->name('remove.from.cart');
Route::get("/checkout", [CartController::class, 'checkout'])->name("checkout");

Route::group(['prefix' => 'user', 'middleware' => 'auth:customers'], function () {
    Route::get('/dashboard', [UserPanelController::class, 'index'])->name('user.dashboard');
    Route::get('/logout', [CustomerController::class, 'logout'])->name('user.logout');
    Route::get("/all-booking", [UserPanelController::class, 'allBooking'])->name('user.all.booking');
    Route::get("/booking/cancel/{id}", [UserBookingController::class, 'cancel'])->name('user.cancel.booking');
    Route::get('/profile', [HomeController::class, 'profile'])->name('user.profile');
    Route::get('/profile/edit', [HomeController::class, 'profileEdit'])->name('user.profile.edit');
    Route::post("/update/profile", [CustomerController::class, 'updateProfile'])->name("user.update.profile");
    Route::post('/profile/update', [HomeController::class, 'profileUpdate'])->name('user.profile.update');
    Route::get('/change-password', [HomeController::class, 'changePassword'])->name('user.change.password');
    Route::post('/change-password', [HomeController::class, 'changePasswordUpdate'])->name('user.change.password.update');
    Route::post('/booking/table', [UserBookingController::class, 'booking'])->name('user.booking');
    Route::get("/get/package/info", [UserBookingController::class, 'getPackageInfo'])->name('get.package.info');

    Route::post('/pay/', [SslCommerzPaymentController::class, 'index'])->name("pay.now");
    Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);

    Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
    Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);

    Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
});
Route::post('/success', [SslCommerzPaymentController::class, 'success']);

Route::prefix("admin")->middleware(['auth:web', "check.admin"])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::group(['prefix' => 'admin'], function () {
        Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
    });

    Route::get('/restaurant/list', [RestaurantController::class, 'list'])->name('restaurant.list');
    // restaurant approve
    Route::get('/restaurant/approve/{id}', [RestaurantController::class, 'approve'])->name('restaurant.approve');
    Route::get('/restaurant/reject/{id}', [RestaurantController::class, 'reject'])->name('restaurant.reject');
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
});

Route::name("restaurant.")->prefix("restaurant")->middleware(["auth:restaurants", "check.restaurant"])->group(function () {
    Route::get('/', [RestaurantController::class, "dashboard"])->name("dashboard");
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::resource("categories", CategoryController::class);
    Route::resource("foods", FoodController::class)->except(["show", "destroy"]);
    Route::get("/foods/delete/{id}", [FoodController::class, "delete"])->name("foods.delete");
    Route::get("/orders", [OrderController::class, "index"])->name("orders");
    Route::get("/orders/show/{id}", [OrderController::class, "show"])->name("order.show");
    Route::get("/bookings", [RestaurantController::class, "bookings"])->name("bookings");
    Route::get("/bookings/status/{id}", [RestaurantController::class, "status"])->name("bookings.status");
    Route::post("/bookings/assign-table", [RestaurantController::class, "assignTable"])->name("bookings.table_no");
    Route::get("/orders/delivered/{id}", [OrderController::class, "status"])->name("order.delivered");
    Route::get('/profile', [RestaurantController::class, "profile"])->name("profile");
});
