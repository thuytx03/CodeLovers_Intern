<?php

use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\InterFaceController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\ProductAttributeController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\RatingController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\TypeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\AuthAdminController;
use App\Http\Controllers\Auth\AuthClientController;
use App\Http\Controllers\Auth\SocialController;
use App\Http\Controllers\Client\AboutClientController;
use App\Http\Controllers\Client\BlogClientController;
use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Client\CheckoutController;
use App\Http\Controllers\Client\ContactClientController;
use App\Http\Controllers\Client\CouponClientController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\RatingClientController;
use App\Http\Controllers\Client\ShopController;
use App\Http\Controllers\PaymentController;
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

Route::get('/', [HomeController::class, 'index'])->name('/');
Route::get('/cua-hang', [ShopController::class, 'shop'])->name('cua-hang');
Route::get('/gioi-thieu', [AboutClientController::class, 'index'])->name('gioi-thieu');
Route::match(['GET','POST'],'/lien-he', [ContactClientController::class, 'index'])->name('lien-he');
Route::get('/bai-viet', [BlogClientController::class, 'index'])->name('bai-viet');
Route::get('/chi-tiet-bai-viet/{slug}/{id}', [BlogClientController::class,'detail'])->name('chitietbaiviet');

Route::get('/chi-tiet-san-pham/{slug}/{id}', [ShopController::class, 'productDetail'])->name('chi-tiet-san-pham');
Route::get('/vnPayCheck', [CheckoutController::class, 'vnPayCheck'])->name('vnPayCheck');
Route::get('/ma-giam-gia', [CouponClientController::class, 'index']);


Route::get('/home', [ShopController::class, 'index']);
Route::get('/get-result', [ShopController::class, 'getResult'])->name('get-result');

Route::middleware('auth')->group(function () {
    Route::post('/them-gio-hang', [CartController::class, 'addToCart'])->name('them-gio-hang');
    Route::get('/gio-hang', [CartController::class, 'cart'])->name('gio-hang');
    Route::post('/cap-nhat-gio-hang', [CartController::class, 'updateCart'])->name('cap-nhat-gio-hang');
    Route::get('/xoa-san-pham-trong-gio-hang/{id}', [CartController::class, 'destroy'])->name('xoa-san-pham-trong-gio-hang');
    Route::get('/mua-hang', [CheckoutController::class, 'index'])->name('mua-hang');
    Route::post('/dat-hang', [CheckoutController::class, 'checkout'])->name('dat-hang');
    Route::get('/don-hang', [CheckoutController::class, 'list'])->name('don-hang');
    Route::post('/order/cancel/{id}', [CheckoutController::class, 'cancel'])->name('order.cancel.client');
    Route::post('/vnpay_payment', [PaymentController::class, 'vnpay_payment'])->name('vnpay_payment');
    Route::post('/check-coupon', [CouponClientController::class, 'check'])->name('client.coupon.check');
    Route::post('/clear-coupon-session',[CouponClientController::class, 'clearCouponSession'])->name('clear-coupon-session');
    Route::post('/danh-gia', [RatingClientController::class, 'store'])->name('danh-gia');

});



Route::get('/login', [AuthClientController::class, 'login'])->name('login.client');
Route::post('/saveLogin', [AuthClientController::class, 'saveLogin'])->name('saveLogin.client');
Route::get('/register', [AuthClientController::class, 'register'])->name('register.client');
Route::post('/saveRegister', [AuthClientController::class, 'saveRegister'])->name('saveRegister.client');
Route::get('/logout', [AuthClientController::class, 'logout'])->name('logout.client');
Route::get('/forgotPassword', [AuthClientController::class, 'forgotPassword'])->name('forgot.client');
Route::post('/saveForgotPassword', [AuthClientController::class, 'saveForgotPassword'])->name('saveForgot.client');
Route::get('/google', [SocialController::class, 'redirectToGoogle']);
Route::get('/google/callback', [SocialController::class, 'handleGoogleCallback']);
Route::get('/facebook', [SocialController::class, 'facebookRedirect']);
Route::get('/facebook/callback', [SocialController::class, 'loginWithFacebook']);

Route::get('admin/login', [AuthAdminController::class, 'index'])->name('login.admin');
Route::post('admin/saveLogin', [AuthAdminController::class, 'login'])->name('saveLogin.admin');
Route::get('admin/logout', [AuthAdminController::class, 'logout'])->name('logout.admin');

Route::middleware('auth')->group(function () {
    Route::prefix('/admin/')->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('permission:admin-dashboard');

        Route::prefix('permissions')->group(function () {
            Route::get('/', [PermissionController::class, 'index'])->name('list.permission')->middleware('permission:permission-list');
            Route::get('/add', [PermissionController::class, 'create'])->name('add.permission')->middleware('permission:permission-add');
            Route::post('/saveAdd', [PermissionController::class, 'store'])->name('saveAdd.permission')->middleware('permission:permission-add');
            Route::get('/destroy/{id}', [PermissionController::class, 'destroy'])->name('destroy.permission')->middleware('permission:permission-delete');
            Route::get('/edit/{id}', [PermissionController::class, 'edit'])->name('edit.permission')->middleware('permission:permission-edit');
            Route::put('/update/{id}', [PermissionController::class, 'update'])->name('update.permission')->middleware('permission:permission-edit');
            Route::post('/deleteAll', [PermissionController::class, 'deleteAll'])->name('deleteAll.permission')->middleware('permission:permission-list');
        });

        // role
        Route::prefix('roles')->group(function () {
            Route::get('/', [RoleController::class, 'index'])->name('list.role')->middleware('permission:role-list');
            Route::get('/add', [RoleController::class, 'create'])->name('add.role')->middleware('permission:role-add');
            Route::post('/saveAdd', [RoleController::class, 'store'])->name('saveAdd.role')->middleware('permission:role-add');
            Route::get('/destroy/{id}', [RoleController::class, 'destroy'])->name('destroy.role')->middleware('permission:role-delete');
            Route::get('/edit/{id}', [RoleController::class, 'edit'])->name('edit.role')->middleware('permission:role-edit');
            Route::put('/update/{id}', [RoleController::class, 'update'])->name('update.role')->middleware('permission:role-edit');
            Route::post('/deleteAll', [RoleController::class, 'deleteAll'])->name('deleteAll.role')->middleware('permission:role-list');
        });
        //user
        Route::prefix('users')->group(function () {
            Route::get('/', [UserController::class, 'index'])->name('list.user')->middleware('permission:user-list');
            Route::get('/add', [UserController::class, 'create'])->name('add.user')->middleware('permission:user-add');
            Route::post('/saveAdd', [UserController::class, 'store'])->name('saveAdd.user')->middleware('permission:user-add');
            Route::get('/destroy/{id}', [UserController::class, 'destroy'])->name('destroy.user')->middleware('permission:user-delete');
            Route::get('/edit/{id}', [UserController::class, 'edit'])->name('edit.user')->middleware('permission:user-edit');
            Route::put('/update/{id}', [UserController::class, 'update'])->name('update.user')->middleware('permission:user-edit');
            Route::get('/trash', [UserController::class, 'trash'])->name('trash.user')->middleware('permission:user-trash');
            Route::post('/restore', [UserController::class, 'restore'])->name('restore.user')->middleware('permission:user-trash');
            Route::get('/permanentlyDelete/{id}', [UserController::class, 'permanentlyDelete'])->name('permanentlyDelete.user')->middleware('permission:user-trash');
            Route::post('/deleteAll', [UserController::class, 'deleteAll'])->name('deleteAll.user')->middleware('permission:user-list');
            Route::post('/update-status/{id}', [UserController::class, 'updateStatus'])->name('updateStatus.user')->middleware('permission:user-edit');

        });

        // danh mục
        Route::prefix('categories')->group(function () {
            Route::get('/', [CategoryController::class, 'index'])->name('list.categories')->middleware('permission:category-list');
            Route::get('/add', [CategoryController::class, 'create'])->name('add.categories')->middleware('permission:category-add');
            Route::post('/saveAdd', [CategoryController::class, 'store'])->name('saveAdd.categories')->middleware('permission:category-add');
            Route::get('/destroy/{id}', [CategoryController::class, 'destroy'])->name('destroy.categories')->middleware('permission:category-delete');
            Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('edit.categories')->middleware('permission:category-edit');
            Route::put('/update/{id}', [CategoryController::class, 'update'])->name('update.categories')->middleware('permission:category-edit');
            Route::get('/trash', [CategoryController::class, 'trash'])->name('trash.categories')->middleware('permission:category-trash');
            Route::post('/restore', [CategoryController::class, 'restore'])->name('restore.categories')->middleware('permission:category-trash');
            Route::get('/permanentlyDelete/{id}', [CategoryController::class, 'permanentlyDelete'])->name('permanentlyDelete.categories')->middleware('permission:category-trash');
            Route::post('/deleteAll', [CategoryController::class, 'deleteAll'])->name('deleteAll.categories')->middleware('permission:category-trash');
        });
        //thuộc tính
        Route::prefix('attributes')->group(function () {
            Route::get('/color', [ProductAttributeController::class, 'indexColor'])->name('listColor.attributes')->middleware('permission:color-list');
            Route::get('/size', [ProductAttributeController::class, 'indexSize'])->name('listSize.attributes')->middleware('permission:size-list');
            Route::match(['GET', 'POST'], '/addColor', [ProductAttributeController::class, 'addColor'])->name('addColor.attributes')->middleware('permission:color-add');
            Route::match(['GET', 'POST'], '/editColor/{id}', [ProductAttributeController::class, 'editColor'])->name('editColor.attributes')->middleware('permission:color-edit');
            Route::get('/destroyColor/{id}', [ProductAttributeController::class, 'destroyColor'])->name('destroyColor.attributes')->middleware('permission:color-delete');
            Route::post('/deleteAllColor', [ProductAttributeController::class, 'deleteAllColor'])->name('deleteAllColor.attributes')->middleware('permission:color-list');

            Route::match(['GET', 'POST'], '/addSize', [ProductAttributeController::class, 'addSize'])->name('addSize.attributes')->middleware('permission:size-add');
            Route::match(['GET', 'POST'], '/editSize/{id}', [ProductAttributeController::class, 'editSize'])->name('editSize.attributes')->middleware('permission:size-edit');
            Route::get('/destroySize/{id}', [ProductAttributeController::class, 'destroySize'])->name('destroySize.attributes')->middleware('permission:size-delete');
            Route::post('/deleteAllSize', [ProductAttributeController::class, 'deleteAllSize'])->name('deleteAllSize.attributes')->middleware('permission:size-delete');

            // Route::get('/trash', [ProductAttributeController::class, 'trash'])->name('trash.attributes');
            // Route::post('/restore', [ProductAttributeController::class, 'restore'])->name('restore.attributes');
            // Route::get('/permanentlyDelete/{id}', [ProductAttributeController::class, 'permanentlyDelete'])->name('permanentlyDelete.attributes');
        });

        ///sản phẩm
        Route::prefix('product')->group(function () {
            Route::get('/', [ProductController::class, 'index'])->name('list.product')->middleware('permission:product-list');
            Route::get('/create', [ProductController::class, 'create'])->name('create.product')->middleware('permission:product-add');
            Route::post('/store', [ProductController::class, 'store'])->name('store.product')->middleware('permission:product-add');
            Route::get('/destroy/{id}', [ProductController::class, 'destroy'])->name('destroy.product')->middleware('permission:product-delete');
            Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('edit.product')->middleware('permission:product-edit');
            Route::put('/update/{id}', [ProductController::class, 'update'])->name('update.product')->middleware('permission:product-edit');
            Route::get('/show/{id}', [ProductController::class, 'show'])->name('show.product')->middleware('permission:product-list');
            Route::get('/trash', [ProductController::class, 'trash'])->name('trash.product')->middleware('permission:product-trash');
            Route::post('/restore', [ProductController::class, 'restore'])->name('restore.product')->middleware('permission:product-trash');
            Route::get('/permanentlyDelete/{id}', [ProductController::class, 'permanentlyDelete'])->name('permanentlyDelete.product')->middleware('permission:product-trash');
            Route::post('/deleteAll', [ProductController::class, 'deleteAll'])->name('deleteAll.product')->middleware('permission:product-delete');
        });

        Route::prefix('interfaces')->group(function () {
            Route::match(['GET', 'POST'], '/logo/{id}', [InterFaceController::class, 'logo'])->name('logo.interfaces')->middleware('permission:logo-interface');
            Route::prefix('slider')->group(function () {
                Route::get('/', [InterFaceController::class, 'index'])->name('list.slider')->middleware('permission:slider-list');
                Route::get('/add', [InterFaceController::class, 'create'])->name('add.slider')->middleware('permission:slider-add');
                Route::post('/saveAdd', [InterFaceController::class, 'store'])->name('saveAdd.slider')->middleware('permission:slider-add');
                Route::get('/destroy/{id}', [InterFaceController::class, 'destroy'])->name('destroy.slider')->middleware('permission:slider-delete');
                Route::get('/edit/{id}', [InterFaceController::class, 'edit'])->name('edit.slider')->middleware('permission:slider-edit');
                Route::put('/update/{id}', [InterFaceController::class, 'update'])->name('update.slider')->middleware('permission:slider-edit');
            });
        });

        // đơn hàng
        Route::prefix('order')->group(function () {
            Route::get('/', [OrderController::class, 'index'])->name('list.order')->middleware('permission:order-list');
            Route::get('/{id}/detail', [OrderController::class, 'detail'])->name('order.detail')->middleware('permission:order-list');
            Route::get('/{id}/confirm', [OrderController::class, 'confirm'])->name('order.confirm')->middleware('permission:order-list');
            Route::post('/{id}/cancel', [OrderController::class, 'cancel'])->name('order.cancel')->middleware('permission:order-list');
            Route::get('/{id}/delivered', [OrderController::class, 'delivered'])->name('order.delivered')->middleware('permission:order-list');
            Route::get('/{id}/delivering', [OrderController::class, 'delivering'])->name('order.delivering')->middleware('permission:order-list');
        });

        //mã giảmg giá
        Route::prefix('coupons')->group(function () {
            Route::get('/', [CouponController::class, 'index'])->name('list.coupon')->middleware('permission:coupon-list');
            Route::match(['GET', 'POST'], '/add', [CouponController::class, 'add'])->name('add.coupon')->middleware('permission:coupon-add');
            Route::match(['GET', 'POST'], '/edit/{id}', [CouponController::class, 'edit'])->name('edit.coupon')->middleware('permission:coupon-edit');
            Route::get('/destroy/{id}', [CouponController::class, 'destroy'])->name('destroy.coupon')->middleware('permission:coupon-delete');
            Route::post('/deleteAll', [CouponController::class, 'deleteAll'])->name('deleteAll.coupon')->middleware('permission:coupon-delete');
        });

        //liên hệ tư vấn
        Route::prefix('contacts')->group(function () {
            Route::get('/', [ContactController::class, 'index'])->name('list.contact');
            Route::get('/confirm/{id}', [ContactController::class, 'confirm'])->name('confirm.contact')->middleware('permission:contact-list');

        });

        // danh mục bài viết
        Route::prefix('types')->group(function () {
            Route::get('/', [TypeController::class, 'index'])->name('list.types')->middleware('permission:type-list');
            Route::get('/add', [TypeController::class, 'create'])->name('add.types')->middleware('permission:type-add');
            Route::post('/saveAdd', [TypeController::class, 'store'])->name('saveAdd.types')->middleware('permission:type-add');
            Route::get('/destroy/{id}', [TypeController::class, 'destroy'])->name('destroy.types')->middleware('permission:type-delete');
            Route::get('/edit/{id}', [TypeController::class, 'edit'])->name('edit.types')->middleware('permission:type-edit');
            Route::put('/update/{id}', [TypeController::class, 'update'])->name('update.types')->middleware('permission:type-edit');
            Route::get('/trash', [TypeController::class, 'trash'])->name('trash.types')->middleware('permission:type-trash');
            Route::post('/restore', [TypeController::class, 'restore'])->name('restore.types')->middleware('permission:type-trash');
            Route::get('/permanentlyDelete/{id}', [TypeController::class, 'permanentlyDelete'])->name('permanentlyDelete.types')->middleware('permission:type-trash');
            Route::post('/deleteAll', [TypeController::class, 'deleteAll'])->name('deleteAll.types')->middleware('permission:type-delete');
        });

        //bài viết
        Route::prefix('blogs')->group(function () {
            Route::get('/', [BlogController::class, 'index'])->name('list.blogs')->middleware('permission:blog-list');
            Route::get('/add', [BlogController::class, 'create'])->name('add.blogs')->middleware('permission:blog-add');
            Route::post('/saveAdd', [BlogController::class, 'store'])->name('saveAdd.blogs')->middleware('permission:blog-add');
            Route::get('/edit/{id}', [BlogController::class, 'edit'])->name('edit.blogs')->middleware('permission:blog-edit');
            Route::put('/update/{id}', [BlogController::class, 'update'])->name('update.blogs')->middleware('permission:blog-edit');
            Route::get('/destroy/{id}', [BlogController::class, 'destroy'])->name('destroy.blogs')->middleware('permission:blog-delete');
            Route::get('/trash', [BlogController::class, 'trash'])->name('trash.blogs')->middleware('permission:blog-trash');
            Route::post('/restore', [BlogController::class, 'restore'])->name('restore.blogs')->middleware('permission:blog-trash');
            Route::get('/permanentlyDelete/{id}', [BlogController::class, 'permanentlyDelete'])->name('permanentlyDelete.blogs')->middleware('permission:blog-trash');
            Route::post('/deleteAll', [BlogController::class, 'deleteAll'])->name('deleteAll.blogs')->middleware('permission:blog-delete');
        });

        Route::prefix('rating')->group(function () {
            Route::get('/', [RatingController::class, 'index'])->name('list.rating')->middleware('permission:rating-list');
            Route::get('/destroy/{id}', [RatingController::class, 'destroy'])->name('destroy.rating')->middleware('permission:rating-list');
            Route::post('/deleteAll', [RatingController::class, 'deleteAll'])->name('deleteAll.rating')->middleware('permission:rating-list');

        });
    });
});
