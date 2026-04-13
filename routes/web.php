<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ContactController::class, 'index']);
Route::post('/confirm', [ContactController::class, 'confirm']);
Route::post('/thanks', [ContactController::class, 'store'])->name('contacts.store');

Route::get('/register', [RegisterController::class, 'create'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/login', [LoginController::class, 'show'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::middleware('auth')->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/admin/search', [AdminController::class, 'search'])->name('admin.search');
    Route::get('/search', [AdminController::class, 'search']);
    Route::get('/reset', [AdminController::class, 'reset']);
    Route::post('/delete', [AdminController::class, 'destroy'])->name('admin.delete');
    Route::get('/export', [AdminController::class, 'export'])->name('admin.export');
});

