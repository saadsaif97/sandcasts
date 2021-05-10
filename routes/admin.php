<?php

use App\Http\Controllers\Admin\LessonController;
use App\Http\Controllers\Admin\SeriesContoller;
use Illuminate\Support\Facades\Route;

Route::resource('series', SeriesContoller::class);
Route::resource('{series_by_id}/lessons', LessonController::class);