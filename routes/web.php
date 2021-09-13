<?php

use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\Admin\SubcategoryController;
use App\Http\Controllers\Admin\Sub_subcategoryController;
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


//Admin routes grouped for back button prevention after logging out
Route::group(['middleware' => ['prevent-back-button', 'XssSanitizer']], function () {
    //Admin Route after login
    Route::group(['middleware' => ['admin:admin']], function () {
        Route::get('/aov', [AdminController::class, 'index']);
        Route::post('/admin/login', [AdminController::class, 'store'])->name('admin.login');
    });

    //uses admin auth guard. for admins
    Route::middleware(['auth:admin,admin'])->get('/admin/dashboard', function () {
        return view('admin.index');
    })->name('dashboard.admin');

    //admin profile routes
    Route::get('/admin/profile', [AdminProfileController::class, 'index'])->name('admin.profile'); //view

    Route::get('/admin/profile/edit', [AdminProfileController::class, 'edit'])->name('admin.profile.edit'); //edit profile
    Route::post('/admin/profile/update', [AdminProfileController::class, 'update'])->name('admin.profile.update'); //save updates

    Route::get('/admin/profile/password', [AdminProfileController::class, 'changePassword'])->name('admin.password.change'); //change admin pwd
    Route::post('/admin/profile/password/update', [AdminProfileController::class, 'updatePassword'])->name('admin.password.update'); //update admin pwd

    Route::get('/admin/logout', [AdminController::class, 'destroy'])->name('admin.logout'); //logout admin


    //category routes
    Route::get('/admin/categories', [CategoryController::class, 'index'])->name('category.all'); //category index
    Route::post('/admin/categories/add', [CategoryController::class, 'create'])->name('category.add'); //category add
    Route::get('/admin/category/soft-delete/{id}', [CategoryController::class, 'delete'])->name('category.soft-delete'); //category soft delete
    Route::get('/admin/category/delete/{id}', [CategoryController::class, 'destroy'])->name('category.delete'); //category destroy
    Route::get('/admin/category/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit'); //category edit
    Route::post('/admin/category/update', [CategoryController::class, 'update'])->name('category.update'); //category update
    Route::post('/admin/category/restore', [CategoryController::class, 'restore'])->name('category.restore'); //category restore

    //sub category routes
    Route::get('/admin/sub-categories', [SubcategoryController::class, 'index'])->name('subcategory.all'); //sub-category index
    Route::post('/admin/sub-category/add', [SubcategoryController::class, 'create'])->name('subcategory.add'); //sub-category add
    Route::get('/admin/sub-category/edit/{id}', [SubcategoryController::class, 'edit'])->name('subcategory.edit'); //sub-category edit
    Route::post('/admin/sub-category/update', [SubcategoryController::class, 'update'])->name('subcategory.update'); //sub-category update
    Route::get('/admin/sub-category/soft-delete/{id}', [SubcategoryController::class, 'delete'])->name('subcategory.soft-delete'); //subcategory soft delete
    Route::post('/admin/sub-category/restore', [SubcategoryController::class, 'restore'])->name('subcategory.restore'); //subcategory restore
    Route::get('/admin/sub-category/delete/{id}', [SubcategoryController::class, 'destroy'])->name('subcategory.delete'); //subcategory destroy

    //sub sub-category routes
    Route::get('/admin/sub-subcategories', [Sub_subcategoryController::class, 'index'])->name('sub.subcategory.all'); //sub-subcategory index
    Route::post('/admin/sub-subcategory/add', [Sub_subcategoryController::class, 'create'])->name('sub.subcategory.add'); //sub-category add
    Route::post('/admin/sub-subcategory/ajax/{category_id}', [Sub_subcategoryController::class, 'getSubCategory'])->name('sub.subcategory.ajax'); //sub-category add

});




//User Routes
// Route::middleware(['auth:sanctum,web', 'verified'])->get('/', function () { //uses web auth guard, for users
//     return view('user.index');
// })->name('dashboard');


//home route. no auth required
Route::get('/', [IndexController::class, 'index'])->name('home');

//user auth routes
Route::middleware(['auth:sanctum,web', 'verified'])->get('/web/dashboard', [IndexController::class, 'loginRedir'])->name('dashboard');
// Route::middleware(['auth:sanctum,web', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// });

//restricted routes. auth required
Route::group(['middleware' => ['prevent-back-button', 'XssSanitizer']], function () {

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


    Route::get('/forgot-password-sent', [IndexController::class, 'password_reset_redir'])->name('password.reset.sent'); //forgot password email

});
