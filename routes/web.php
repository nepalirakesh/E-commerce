<?php

use App\Http\Controllers\CategoryController;
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


Route::get('/dashboard', function () {
    return view('dashboard.dashboard');
});

Route::get('/', function () {
    return view('home.store');
});

Auth::routes();

// ----------------------------routes for Category------------------------------

Route::group(['prefix'=>'category'],function(){
    Route::get('/',[CategoryController::class,'index'])->name('category.index');
    Route::get('/create',[CategoryController::class,'create'])->name('category.create');
    Route::post('/store',[CategoryController::class,'store'])->name('category.store');
    Route::get('/show/{category}',[CategoryController::class,'show'])->name('category.show');
    Route::get('/edit/{category}',[CategoryController::class,'edit'])->name('category.edit');
    Route::put('/update/{category}',[CategoryController::class,'update'])->name('category.update');
    Route::delete('/delete/{category}',[CategoryController::class,'destroy'])->name('category.delete');
});


