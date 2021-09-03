<?php

use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\AdminController;
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

Route::get('/', function () {
    return view('welcome');
});


//uses web auth guard, for users
Route::middleware(['auth:sanctum,web', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');







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

    Route::get('/admin/logout', [AdminController::class, 'destroy'])->name('admin.logout');
    Route::get('/admin/profile', [AdminProfileController::class, 'index'])->name('admin.profile');
    Route::get('/admin/profile/edit', [AdminProfileController::class, 'edit'])->name('admin.profile.edit');
    Route::post('/admin/profile/update', [AdminProfileController::class, 'update'])->name('admin.profile.update');
    Route::get('/admin/profile/password', [AdminProfileController::class, 'changePassword'])->name('admin.password.change');
    Route::post('/admin/profile/password/update', [AdminProfileController::class, 'updatePassword'])->name('admin.password.update');
});
