<?php

use App\Http\Controllers\ConfirmEmailController;
use App\Http\Controllers\FrontendController;
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

Route::get('/', [FrontendController::class, 'index'])->name('home');
Route::get('/profile/{user}', [FrontendController::class, 'profile'])->name('profile');


Route::get('/logout', function () { Auth::logout(); });
Auth::routes();
Route::get('/register/confirm', [ConfirmEmailController::class, 'index'])->name('confirm-email');


Route::middleware(['auth'])->group(function () {  
   Route::get('/series/{series}', [FrontendController::class, 'singleSeries'])->name('series.single');
   Route::get('/series/{series}/watch/{lesson?}', [FrontendController::class, 'watchSeries'])->name('series.watch');
   Route::post('/series/complete-lesson/{lesson}', [FrontendController::class, 'completeLesson'])->name('series.lesson.complete');
});