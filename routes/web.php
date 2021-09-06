<?php

use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\User\IndexController;
use App\Http\Controllers\user\UserController;
use App\Http\Controllers\user\UserProfileController;
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


//Admin routes grouped for logout redirect
Route::group(['middleware' => 'prevent-back-button'], function () {
    //Admin Route after login
    Route::group(['middleware' => ['admin:admin']], function () {
        Route::get('/aov', [AdminController::class, 'index']);
        Route::post('/admin/login', [AdminController::class, 'store'])->name('admin.login');
    });

    //uses admin auth guard. for admins
    Route::middleware(['auth:admin,admin', 'verified'])->get('/admin/dashboard', function () {
        return view('admin.index');
    })->name('dashboard.admin');

    Route::get('/admin/profile', [AdminProfileController::class, 'index'])->name('admin.profile');

    //sanitized
    Route::group(['middleware' => ['XssSanitizer']], function () {
        Route::get('/admin/profile/edit', [AdminProfileController::class, 'edit'])->name('admin.profile.edit');
        Route::post('/admin/profile/update', [AdminProfileController::class, 'update'])->name('admin.profile.update');
    });

    Route::get('/admin/profile/password', [AdminProfileController::class, 'changePassword'])->name('admin.password.change');
    Route::post('/admin/profile/password/update', [AdminProfileController::class, 'updatePassword'])->name('admin.password.update');

    Route::get('/admin/logout', [AdminController::class, 'destroy'])->name('admin.logout'); //logout admin
});


//User Routes
// Route::middleware(['auth:sanctum,web', 'verified'])->get('/', function () { //uses web auth guard, for users
//     return view('user.index');
// })->name('dashboard');


//home route. no auth required
Route::get('/', [IndexController::class, 'index'])->name('home');

//user auth routes
Route::middleware(['auth:sanctum,web', 'verified'])->get('/web/dashboard', [IndexController::class, 'loginRedir'])->name('dashboard');
Route::middleware(['auth:sanctum,web', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
});

//restricted routes. auth required
Route::group(['middleware' => ['prevent-back-button']], function () {

    //user profile routes
    Route::get('/profile', [UserProfileController::class, 'index'])->name('user.profile');
    Route::get('/user/logout', [UserController::class, 'destroy'])->name('user.logout');

    //sanitization middleware
    Route::group(['middleware' => ['XssSanitizer']], function () {
        Route::get('/user/edit', [UserProfileController::class, 'editProfile'])->name('user.profile.edit');
        Route::post('/user/update', [UserProfileController::class, 'updateProfile'])->name('user.profile.edit.save');
    });

    //user password
    Route::get('/user/password', [UserProfileController::class, 'changePassword'])->name('user.password.change');
    Route::post('/user/password/save', [UserProfileController::class, 'updatePassword'])->name('user.password.change.save');

    //verify user email
    Route::get('/email/verify', function () {
        return view('auth.verify-email');
    })->middleware('auth')->name('verification.notice');
});


Route::get('/forgot-password-sent', [IndexController::class, 'password_reset_redir'])->name('password.reset.sent');
