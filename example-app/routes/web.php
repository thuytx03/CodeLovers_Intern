<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\InterFaceController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductAttributeController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\AuthAdminController;
use App\Http\Controllers\Auth\AuthClientController;
use App\Http\Controllers\Auth\SocialController;
use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Client\CheckoutController;
use App\Http\Controllers\Client\HomeController;
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
Route::get('/chi-tiet-san-pham/{slug}/{id}', [ShopController::class, 'productDetail'])->name('chi-tiet-san-pham');
Route::get('/vnPayCheck', [CheckoutController::class, 'vnPayCheck'])->name('vnPayCheck');

Route::middleware('auth')->group(function () {
    Route::post('/them-gio-hang', [CartController::class, 'addToCart'])->name('them-gio-hang');
    Route::get('/gio-hang', [CartController::class, 'cart'])->name('gio-hang');
    Route::post('/cap-nhat-gio-hang', [CartController::class, 'updateCart'])->name('cap-nhat-gio-hang');
    Route::get('/xoa-san-pham-trong-gio-hang/{id}', [CartController::class, 'destroy'])->name('xoa-san-pham-trong-gio-hang');
    Route::get('/mua-hang', [CheckoutController::class, 'index'])->name('mua-hang');
    Route::post('/dat-hang', [CheckoutController::class, 'checkout'])->name('dat-hang');
    Route::get('/don-hang', [CheckoutController::class, 'list'])->name('don-hang');
    Route::get('/{id}/cancel', [CheckoutController::class, 'cancel'])->name('order.cancel');
    Route::post('/vnpay_payment', [PaymentController::class, 'vnpay_payment'])->name('vnpay_payment');
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


Route::get('admin/login', [AuthAdminController::class, 'index'])->name('login.admin');
Route::post('admin/saveLogin', [AuthAdminController::class, 'login'])->name('saveLogin.admin');
Route::get('admin/logout', [AuthAdminController::class, 'logout'])->name('logout.admin');

Route::middleware('CheckAdmin')->group(function () {
    Route::prefix('/admin/')->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        // role
        Route::prefix('roles')->group(function () {
            Route::get('/', [RoleController::class, 'index'])->name('list.role');
            Route::get('/trash', [RoleController::class, 'trash'])->name('trash.role');
            Route::post('/restore', [RoleController::class, 'restore'])->name('restore.role');
            Route::get('/permanentlyDelete/{id}', [RoleController::class, 'permanentlyDelete'])->name('permanentlyDelete.role');
            Route::get('/add', [RoleController::class, 'create'])->name('add.role');
            Route::post('/saveAdd', [RoleController::class, 'store'])->name('saveAdd.role');
            Route::get('/destroy/{id}', [RoleController::class, 'destroy'])->name('destroy.role');
            Route::get('/edit/{id}', [RoleController::class, 'edit'])->name('edit.role');
            Route::put('/update/{id}', [RoleController::class, 'update'])->name('update.role');
            Route::post('/deleteAll', [RoleController::class, 'deleteAll'])->name('deleteAll.role');
        });
        //user
        Route::prefix('users')->group(function () {
            Route::get('/', [UserController::class, 'index'])->name('list.user');
            Route::get('/add', [UserController::class, 'create'])->name('add.user');
            Route::post('/saveAdd', [UserController::class, 'store'])->name('saveAdd.user');
            Route::get('/destroy/{id}', [UserController::class, 'destroy'])->name('destroy.user');
            Route::get('/edit/{id}', [UserController::class, 'edit'])->name('edit.user');
            Route::put('/update/{id}', [UserController::class, 'update'])->name('update.user');
            Route::get('/trash', [UserController::class, 'trash'])->name('trash.user');
            Route::post('/restore', [UserController::class, 'restore'])->name('restore.user');
            Route::get('/permanentlyDelete/{id}', [UserController::class, 'permanentlyDelete'])->name('permanentlyDelete.user');
            Route::post('/deleteAll', [UserController::class, 'deleteAll'])->name('deleteAll.user');
        });
        // danh mục
        Route::prefix('categories')->group(function () {
            Route::get('/', [CategoryController::class, 'index'])->name('list.categories');
            Route::get('/add', [CategoryController::class, 'create'])->name('add.categories');
            Route::post('/saveAdd', [CategoryController::class, 'store'])->name('saveAdd.categories');
            Route::get('/destroy/{id}', [CategoryController::class, 'destroy'])->name('destroy.categories');
            Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('edit.categories');
            Route::put('/update/{id}', [CategoryController::class, 'update'])->name('update.categories');
            Route::get('/trash', [CategoryController::class, 'trash'])->name('trash.categories');
            Route::post('/restore', [CategoryController::class, 'restore'])->name('restore.categories');
            Route::get('/permanentlyDelete/{id}', [CategoryController::class, 'permanentlyDelete'])->name('permanentlyDelete.categories');
            Route::post('/deleteAll', [CategoryController::class, 'deleteAll'])->name('deleteAll.categories');
        });
        //thuộc tính
        Route::prefix('attributes')->group(function () {
            Route::get('/color', [ProductAttributeController::class, 'indexColor'])->name('listColor.attributes');
            Route::get('/size', [ProductAttributeController::class, 'indexSize'])->name('listSize.attributes');
            Route::match(['GET', 'POST'], '/addColor', [ProductAttributeController::class, 'addColor'])->name('addColor.attributes');
            Route::match(['GET', 'POST'], '/editColor/{id}', [ProductAttributeController::class, 'editColor'])->name('editColor.attributes');
            Route::get('/destroyColor/{id}', [ProductAttributeController::class, 'destroyColor'])->name('destroyColor.attributes');
            Route::post('/deleteAllColor', [ProductAttributeController::class, 'deleteAllColor'])->name('deleteAllColor.attributes');

            Route::match(['GET', 'POST'], '/addSize', [ProductAttributeController::class, 'addSize'])->name('addSize.attributes');
            Route::match(['GET', 'POST'], '/editSize/{id}', [ProductAttributeController::class, 'editSize'])->name('editSize.attributes');
            Route::get('/destroySize/{id}', [ProductAttributeController::class, 'destroySize'])->name('destroySize.attributes');
            Route::post('/deleteAllSize', [ProductAttributeController::class, 'deleteAllSize'])->name('deleteAllSize.attributes');

            Route::get('/trash', [ProductAttributeController::class, 'trash'])->name('trash.attributes');
            Route::post('/restore', [ProductAttributeController::class, 'restore'])->name('restore.attributes');
            Route::get('/permanentlyDelete/{id}', [ProductAttributeController::class, 'permanentlyDelete'])->name('permanentlyDelete.attributes');
        });

        ///sản phẩm
        Route::prefix('product')->group(function () {
            Route::get('/', [ProductController::class, 'index'])->name('list.product');
            Route::get('/create', [ProductController::class, 'create'])->name('create.product');
            Route::post('/store', [ProductController::class, 'store'])->name('store.product');
            Route::get('/destroy/{id}', [ProductController::class, 'destroy'])->name('destroy.product');
            Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('edit.product');
            Route::put('/update/{id}', [ProductController::class, 'update'])->name('update.product');
            Route::get('/show/{id}', [ProductController::class, 'show'])->name('show.product');
            Route::get('/trash', [ProductController::class, 'trash'])->name('trash.product');
            Route::post('/restore', [ProductController::class, 'restore'])->name('restore.product');
            Route::get('/permanentlyDelete/{id}', [ProductController::class, 'permanentlyDelete'])->name('permanentlyDelete.product');
            Route::post('/deleteAll', [ProductController::class, 'deleteAll'])->name('deleteAll.product');
        });

        Route::prefix('interfaces')->group(function () {
            Route::match(['GET', 'POST'], '/logo/{id}', [InterFaceController::class, 'logo'])->name('logo.interfaces');
            Route::prefix('slider')->group(function () {
                Route::get('/', [InterFaceController::class, 'index'])->name('list.slider');
                Route::get('/add', [InterFaceController::class, 'create'])->name('add.slider');
                Route::post('/saveAdd', [InterFaceController::class, 'store'])->name('saveAdd.slider');
                Route::get('/destroy/{id}', [InterFaceController::class, 'destroy'])->name('destroy.slider');
                Route::get('/edit/{id}', [InterFaceController::class, 'edit'])->name('edit.slider');
                Route::put('/update/{id}', [InterFaceController::class, 'update'])->name('update.slider');
            });
        });

        Route::prefix('order')->group(function () {
            Route::get('/', [OrderController::class, 'index'])->name('list.order');
            Route::get('/{id}/detail', [OrderController::class, 'detail'])->name('order.detail');
            Route::get('/{id}/confirm', [OrderController::class, 'confirm'])->name('order.confirm');
            Route::get('/{id}/cancel', [OrderController::class, 'cancel'])->name('order.cancel');
        });
    });
});
