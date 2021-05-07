<?php

use App\Http\Controllers\ConfirmEmailController;
use App\Http\Controllers\SeriesContoller;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});


Route::get('/logout', function () {
    Auth::logout();
});

Route::get('/custom', function () {
    return view('front.index');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/register/confirm', [ConfirmEmailController::class, 'index'])->name('confirm-email');

Route::middleware('admin')->prefix('admin')->group(function () {
    Route::resource('series', SeriesContoller::class);
});

