<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;

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


// Route::get('/dashboard', function () {
//     return view('dashboard.dashboard');
// });
Route::get('/general-form', function () {
    return view('dashboard.generalform');
});
Route::get('/data-table', function () {
    return view('dashboard.data');
});
Route::get('/advance-form', function () {
    return view('dashboard.advanceform');
});
// Route::get('/', function () {
//     return view('home.store');
// });

Auth::routes();


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/user/logout', [LoginController::class, 'userLogout'])->name('user.logout');

Route::group(['prefix' => 'admin'], function () {
    Route::group(
        ['middleware' => 'admin.guest'],
        function () {
            Route::view('/login', 'admin.login')->name('admin.login');
            Route::post('login', [AdminController::class, 'authenticate'])->name('admin.auth');
        }
    );

    Route::group(
        ['middleware' => 'admin.auth'],
        function () {
            Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('admin.dashboard');
            Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout');
        }
    );
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