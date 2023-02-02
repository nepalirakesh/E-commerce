<?php

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
    return view('layouts.dashboard.dashboard');
});
Route::get('/general-form', function () {
    return view('layouts.dashboard.generalform');
});
Route::get('/data-table', function () {
    return view('layouts.dashboard.data');
});
Route::get('/advance-form', function () {
    return view('layouts.dashboard.advanceform');
});
Route::get('/', function () {
    return view('home.store');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);
