<?php

use App\Http\Controllers\NotesController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('auth/Login');
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth'])->name('dashboard');

Route::group(['middleware' => 'auth'], function () {
    Route::get('notes', [NotesController::class, 'create'])->name('notes.create');
    Route::post('notes', [NotesController::class, 'store'])->name('notes.store');
    Route::get('notes/{note}', [NotesController::class, 'show'])->name('notes.show');
    Route::get('notes/{note}/edit', [NotesController::class, 'edit'])->name('notes.edit');
    Route::put('notes/{note}', [NotesController::class, 'update'])->name('notes.update');
    Route::delete('notes/{note}', [NotesController::class, 'destroy'])->name('notes.destroy');
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
