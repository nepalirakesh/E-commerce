<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StripePaymentController;
use App\Http\Controllers\UserController;
use App\Http\Livewire\CartComponent;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\RegisterController;
use GrahamCampbell\ResultType\Success;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\WebcamController;
use App\Http\Controllers\OrderController;

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

Auth::routes();


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/order', [HomeController::class, 'order'])->name('user.order');

//Route for single page product
Route::get('home/product/{product}', [HomeController::class, 'product_page'])->name('product.page');

Route::get('home/search', [HomeController::class, 'search'])->name('search');

// -------------------------Route for price filter------------------------
Route::get('home/price', [HomeController::class, 'price_filter'])->name('product.price');

Route::post('/user/logout', [LoginController::class, 'userLogout'])->name('user.logout');
Route::get('/home/categories/{category}', [HomeController::class, 'productByCategory'])->name('productByCategory');

Route::group(['prefix' => 'admin'], function () {
    Route::group(
        ['middleware' => 'admin.guest'],
        function () {
            Route::view('/login', 'admin.login')->name('admin.login');
            Route::post('/login', [AdminController::class, 'authenticate'])->name('admin.auth');
        }
    );

    Route::group(
        ['middleware' => 'admin.auth'],
        function () {
            Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('admin.dashboard');
            Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout');
            Route::get('users', [UserController::class, 'index'])->name('users.index');
            Route::get('users-data', [UserController::class, 'getData'])->name('users.data');

            Route::get('orders', [OrderController::class, 'index'])->name('orders.index');
            Route::get('orders-data', [OrderController::class, 'getData'])->name('orders.data');
            Route::get('order_detail/{id}', [OrderController::class, 'order_detail'])->name('order.detail');
            Route::put('update-order/{id}', [OrderController::class, 'update_order']);
        }
    );
});


// --------------------------Route for product Crud-----------------------------

Route::group(['middleware' => 'admin.auth'], function () {

    Route::get('/product', [ProductController::class, 'index'])->name('product.index');
    Route::get('/create', [ProductController::class, 'create'])->name('product.create');
    Route::post('/store', [ProductController::class, 'store'])->name('product.store');
    Route::get('/show/{product}', [Productcontroller::class, 'show'])->name('product.show');
    Route::get('/edit/{product}', [Productcontroller::class, 'edit'])->name('product.edit');
    Route::put('/update/{product}', [Productcontroller::class, 'update'])->name('product.update');
    Route::delete('/delete/{product}', [Productcontroller::class, 'destroy'])->name('product.delete');
});

// ----------------------------routes for Category------------------------------

Route::group(['prefix' => 'category', 'middleware' => 'admin.auth'], function () {
    Route::get('/', [CategoryController::class, 'index'])->name('category.index');
    Route::get('/create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('/store', [CategoryController::class, 'store'])->name('category.store');
    Route::get('/show/{category}', [CategoryController::class, 'show'])->name('category.show');
    Route::get('/edit/{category}', [CategoryController::class, 'edit'])->name('category.edit');
    Route::put('/update/{category}', [CategoryController::class, 'update'])->name('category.update');
    Route::delete('/delete/{category}', [CategoryController::class, 'destroy'])->name('category.delete');
});

// ----------------------------routes for stripe------------------------------

Route::get('stripe', [StripePaymentController::class, 'stripe']);
Route::post('stripe', [StripePaymentController::class, 'stripePost'])->name('stripe.post');

Route::get('checkout', [StripePaymentController::class, 'checkout'])->name('checkout');
Route::get('/success', [StripePaymentController::class, 'success'])->name('checkout.success');
Route::get('/cancel', [StripePaymentController::class, 'cancel'])->name('checkout.cancel');


//--------------Route for User Email Verification-------------------

Route::get('email/verify/{token}', [VerificationController::class, 'verifyEmail'])->name('email.verify');


// ------------------Route for Webcam--------------------------------
Route::get('/webcam', [WebcamController::class, 'index']);
Route::post('/webcam', [WebcamController::class, 'store'])->name('webcam.capture');