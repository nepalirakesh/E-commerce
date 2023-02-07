<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

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


Route::get('/dashboard', function () {
    return view('dashboard.dashboard');
});
Route::get('/general-form', function () {
    return view('dashboard.generalform');
});
Route::get('/data-table', function () {
    return view('dashboard.data');
});
Route::get('/advance-form', function () {
    return view('dashboard.advanceform');
});
Route::get('/', function () {
    return view('home.store');
});

Auth::routes();

// ----------------------------routes for Category------------------------------

Route::group(['prefix' => 'category'], function () {
    Route::get('/', [CategoryController::class, 'index'])->name('category.index');
    Route::get('/create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('/store', [CategoryController::class, 'store'])->name('category.store');
    Route::get('/show/{category}', [CategoryController::class, 'show'])->name('category.show');
    Route::get('/edit/{category}', [CategoryController::class, 'edit'])->name('category.edit');
    Route::put('/update/{category}', [CategoryController::class, 'update'])->name('category.update');
    Route::delete('/delete/{category}', [CategoryController::class, 'destroy'])->name('category.delete');
});



// --------------------------Route for product Crud
Route::get('/product', [ProductController::class, 'index'])->name('product.index');
Route::get('/create', [ProductController::class, 'create'])->name('product.create');
Route::post('/store', [ProductController::class, 'store'])->name('product.store');
route::get('/show/{post}', [Productcontroller::class, 'show'])->name('product.show');
route::get('/edit/{post}', [Productcontroller::class, 'edit'])->name('product.edit');
route::put('/update/{post}', [Productcontroller::class, 'update'])->name('product.update');
route::delete('/delete/{post}', [Productcontroller::class, 'delete'])->name('product.delete');
