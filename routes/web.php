<?php

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


// --------------------------Route for product Crud
Route::get('/product', [ProductController::class, 'index'])->name('product.index');
Route::get('/create', [ProductController::class, 'create'])->name('product.create');
Route::post('/store', [ProductController::class, 'store'])->name('product.store');
route::get('/show/{post}', [Productcontroller::class, 'show'])->name('product.show');
route::get('/edit/{post}', [Productcontroller::class, 'edit'])->name('product.edit');
route::put('/update/{post}', [Productcontroller::class, 'update'])->name('product.update');
route::delete('/delete/{post}', [Productcontroller::class, 'delete'])->name('product.delete');
