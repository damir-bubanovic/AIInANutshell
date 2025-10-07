<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\Admin\ChapterAdminController;
use App\Http\Controllers\Admin\LessonAdminController;
use App\Http\Controllers\SearchController;

// Public site
Route::get('/', [LessonController::class, 'index'])->name('home');
Route::get('/chapters/{chapter:slug}/{lesson:slug}', [LessonController::class, 'show'])->name('lesson.show');

// Breeze default dashboard (kept)
Route::get('/dashboard', function () { return view('dashboard'); })
    ->middleware(['auth', 'verified'])->name('dashboard');

// Authenticated user profile (kept)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin area (login required + admin gate)
Route::middleware(['auth','can:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::redirect('/', '/admin/chapters');
    Route::resource('chapters', ChapterAdminController::class)->except(['show']);
    Route::resource('lessons',  LessonAdminController::class)->except(['show']);
});

Route::get('/search', [SearchController::class, 'index'])->name('search');

require __DIR__.'/auth.php';
