<?php

use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\CarouselController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\InfoController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ShippingLocationController;
use App\Http\Controllers\Admin\SubcategoryController;
use App\Http\Controllers\Admin\Sub_subcategoryController;
use App\Http\Controllers\Admin\VoucherController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\CategoryController as UserCategoryController;
use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\User\CheckoutWrapperController;
use App\Http\Controllers\User\IndexController;
use App\Http\Controllers\User\ProductDeatilsController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\UserProfileController;
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

//Admin Route after login
Route::group(['middleware' => ['admin:admin']], function () {
    Route::get('/aov', [AdminController::class, 'index']);
    Route::post('/admin/login', [AdminController::class, 'store'])->name('admin.login');
});

//uses admin auth guard. for admins
Route::middleware(['auth:sanctum,admin'])->get('/admin/dashboard', function () {
    return view('admin.index');
})->name('dashboard.admin');

Route::group(['middleware' => ['prevent-back-button', 'XssSanitizer', 'auth:sanctum,admin']], function () {
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
    Route::get('admin/carosuel/index', [CarouselController::class, 'index'])->name('carousel-index'); //list carousels
    Route::post('admin/carosuel/add', [CarouselController::class, 'create'])->name('carousel-add'); //add a carousel
    Route::get('admin/carosuel/toggle/{id}', [CarouselController::class, 'ToggleStatus'])->name('carousel-toggle'); //toggle carousel status
    Route::get('admin/carosuel/edit/{id}', [CarouselController::class, 'edit'])->name('carousel-edit'); //edit carousel
    Route::post('admin/carosuel/update', [CarouselController::class, 'update'])->name('carousel-update'); //edit carousel
    Route::get('admin/carosuel/delete/{id}', [CarouselController::class, 'destroy'])->name('carousel-delete'); //delete carousel

    //voucher routes
    Route::get('admin/vouchers/index', [VoucherController::class, 'index'])->name('voucher-index'); //list Vouchers
    Route::post('admin/vouchers/add', [VoucherController::class, 'store'])->name('voucher.add'); //add Vouchers
    Route::get('admin/vouchers/delete/{id}', [VoucherController::class, 'delete'])->name('voucher.delete'); //delete Vouchers
    Route::get('admin/vouchers/edit/{id}', [VoucherController::class, 'edit'])->name('voucher.edit'); //edit Voucher
    Route::post('admin/vouchers/update', [VoucherController::class, 'update'])->name('voucher.update'); //update Voucher
    Route::get('admin/vouchers/toggle/{id}', [VoucherController::class, 'toggleStatus'])->name('voucher.toggle'); //toggle Voucher status

    //shipping location routes
    Route::get('admin/shipping/locations', [ShippingLocationController::class, 'getLoc'])->name('locations-index'); //list location
    Route::post('admin/shipping/division/add', [ShippingLocationController::class, 'addDivision'])->name('locations-division-add'); //add division
    Route::post('admin/shipping/district/add', [ShippingLocationController::class, 'addDistrict'])->name('locations-district-add'); //add district
    Route::get('admin/shipping/delete/{name}/{id}', [ShippingLocationController::class, 'delLoc'])->name('locations-delele'); //del district
    Route::get('admin/shipping/edit/{name}/{id}', [ShippingLocationController::class, 'editLoc'])->name('locations-edit'); //edit district
    Route::post('admin/shipping/district/update', [ShippingLocationController::class, 'updateDistrict'])->name('locations-district-update'); //update district
    Route::get('admin/shipping/toggle/{name}/{id}', [ShippingLocationController::class, 'toggleStatus'])->name('locations-toggle'); //toggle location status
    Route::post('admin/shipping/division/update', [ShippingLocationController::class, 'updateDivision'])->name('locations-division-update'); //update district

    //contact number routes
    Route::get('admin/contact-no/index', [InfoController::class, 'phoneInfo'])->name('phone-index'); //get all contact number
    Route::post('admin/contact-no/add', [InfoController::class, 'addPhone'])->name('phone-add'); //add contact number
    Route::get('admin/contact-no/delete/{id}', [InfoController::class, 'deletePhone'])->name('phone-delete'); //delete contact number

    //email address routes
    Route::get('admin/email-address/index', [InfoController::class, 'emailInfo'])->name('email-index'); //get all email addresses.
    Route::post('admin/email-address/add', [InfoController::class, 'addEmail'])->name('email-add'); //add email addr
    Route::get('admin/email-address/delete/{id}', [InfoController::class, 'deleteEmail'])->name('email-delete'); //delete email addr
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
    Route::get('/user/edit', [UserProfileController::class, 'editProfile'])->name('user.profile.edit');
    Route::post('/user/update', [UserProfileController::class, 'updateProfile'])->name('user.profile.edit.save');

    //user password
    Route::get('/user/password', [UserProfileController::class, 'changePassword'])->name('user.password.change');
    Route::post('/user/password/save', [UserProfileController::class, 'updatePassword'])->name('user.password.change.save');

    //verify user email
    Route::get('/email/verify', function () {
        return view('auth.verify-email');
    })->middleware('auth')->name('verification.notice');

    //checkout route
    Route::get('/checkout', [CheckoutController::class, 'checkout'])->name('checkout');
    Route::get('/checkout/init', [CheckoutWrapperController::class, 'setAndRedir'])->name('checkout-init');
    //get district ajax
    Route::get('/ajax/divison/{id}', [CheckoutController::class, 'getDistList']);
    Route::post('/ajax/applyVoucher', [CheckoutController::class, 'applyVoucher']);
    Route::post('/ajax/deleteVoucher', [CheckoutController::class, 'deleteVoucher']);
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
