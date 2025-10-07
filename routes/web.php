<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LessonController;

/*
Route::get('/', function () {
    return view('welcome');
});
*/

Route::get('/', [LessonController::class, 'index'])->name('home');
Route::get('/chapters/{chapter:slug}/{lesson:slug}', [LessonController::class, 'show'])
    ->name('lesson.show');