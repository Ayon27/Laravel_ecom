<?php

use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\CarouselController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SubcategoryController;
use App\Http\Controllers\Admin\Sub_subcategoryController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\user\CategoryController as UserCategoryController;
use App\Http\Controllers\User\IndexController;
use App\Http\Controllers\User\ProductDeatilsController;
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
    Route::middleware(['auth:sanctum,admin'])->get('/admin/dashboard', function () {
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
    Route::get('/admin/category/delete-all', [CategoryController::class, 'DestroyAll'])->name('category.delete.all'); //category destroy all


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
    Route::post('/admin/sub-subcategory/add', [Sub_subcategoryController::class, 'create'])->name('sub.subcategory.add'); //sub-sub-category add
    Route::post('/admin/sub-subcategory/ajax/{category_id}', [Sub_subcategoryController::class, 'getSubCategory'])->name('sub.subcategory.ajax'); //sub-sub-category add
    Route::get('/admin/sub-subcategory/edit/{id}', [Sub_subcategoryController::class, 'edit'])->name('sub.subcategory.edit'); //sub-sub-category edit
    Route::post('/admin/sub-subcategory/update', [Sub_subcategoryController::class, 'update'])->name('sub.subcategory.update'); //sub-sub-category update
    Route::get('/admin/sub-subcategory/soft-delete/{id}', [Sub_subcategoryController::class, 'delete'])->name('sub.subcategory.soft-delete'); //sub-sub-category soft delete
    Route::post('/admin/sub-subcategory/restore', [Sub_subcategoryController::class, 'restore'])->name('sub.subcategory.restore'); //sub-subcategory restore
    Route::get('/admin/sub-subcategory/delete/{id}', [Sub_subcategoryController::class, 'destroy'])->name('sub.subcategory.delete'); //sub-subcategory destroy
    Route::post('/admin/sub-subcategory/getsubsubcat/ajax/{subcategory_id}', [Sub_subcategoryController::class, 'getSubSubCategory'])->name('sub.subcategory.ajax.getsubcat'); //sub-sub-category add


    //product routes
    Route::get('admin/product/add', [ProductController::class, 'AddProduct'])->name('add-product'); //add a product
    Route::post('admin/product/store', [ProductController::class, 'SaveProduct'])->name('save-product'); //save product
    Route::get('admin/products/all', [ProductController::class, 'index'])->name('manage-product'); //view all products product.destroy
    Route::get('admin/product/{id}', [ProductController::class, 'EditProduct'])->name('product.edit'); //edit product
    Route::post('admin/product/update', [ProductController::class, 'UpdateProduct'])->name('product.update'); //update product
    Route::post('admin/product/update-image', [ProductController::class, 'UpdateProductImage'])->name('product.update.image'); //update product images
    Route::post('admin/product/update-thuimbnail', [ProductController::class, 'UpdateProductThumbnail'])->name('product.update.thumbnail'); //update product thumbnail
    Route::get('admin/product/delete/{id}', [ProductController::class, 'destroy'])->name('product.destroy'); //delete product
    Route::get('admin/product/image/delete/{id}', [ProductController::class, 'DeleteImage'])->name('product-image-delete'); //delete product image
    Route::get('admin/product/toggle/{id}', [ProductController::class, 'ToggleStatus'])->name('product.active.toggle'); //toggle product status

    //Carousel Routes
    Route::get('admin/carosuel/index', [CarouselController::class, 'index'])->name('carousel-index'); //lsit carousels
    Route::post('admin/carosuel/add', [CarouselController::class, 'create'])->name('carousel-add'); //add a carousel
    Route::get('admin/carosuel/toggle/{id}', [CarouselController::class, 'ToggleStatus'])->name('carousel-toggle'); //toggle carousel status
    Route::get('admin/carosuel/edit/{id}', [CarouselController::class, 'edit'])->name('carousel-edit'); //edit carousel
    Route::post('admin/carosuel/update', [CarouselController::class, 'update'])->name('carousel-update'); //edit carousel
    Route::get('admin/carosuel/delete/{id}', [CarouselController::class, 'destroy'])->name('carousel-delete'); //delete carousel

});




//User Routes
// Route::middleware(['auth:sanctum,web', 'verified'])->get('/', function () { //uses web auth guard, for users
//     return view('user.index');
// })->name('dashboard');

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
});


// Route::get('/forgot-password', [IndexController::class, 'password_reset_redir'])->name('password.reset'); //forgot password email
Route::get('/forgot-password-sent', [IndexController::class, 'password_reset_redir'])->name('password.reset.sent'); //forgot password email

//Frontend Routes. No Auth Req
//home route
Route::get('/', [IndexController::class, 'index'])->name('home');

//single product
Route::get('/product/{slug}', [ProductDeatilsController::class, 'ShowProduct'])->name('single-product');

//category wise all products
Route::get('/{slug}', [UserCategoryController::class, 'AllProductsCat'])->name('category-all-products');

//subcategory wise all products
Route::get('/{catSlug}/{subcatSlug}', [UserCategoryController::class, 'AllProductsSubcat'])->name('subcategory-all-products');

//subsubcategory wise all products
Route::get('/{catSlug}/{subcatSlug}/{subsubcatSlug}', [UserCategoryController::class, 'AllProductsSubsubcat'])->name('subsubcategory-all-products');

//add to cart ajax
Route::post('/cart/ajax/add/{productID}', [CartController::class, 'addToCart']);
Route::get('/minicart/ajax/load/{id}', [CartController::class, 'loadMinicart']);

//delete cart ajax
Route::get('/minicart/ajax/deleteItem/{rowId}', [CartController::class, 'deleteCartItem']);

//update cart ajax
Route::get('/minicart/ajax/updateItem/{rowId}', [CartController::class, 'updateItemQty']);
