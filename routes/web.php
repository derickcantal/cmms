<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\manage\ManageUsersController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

});

Route::middleware('auth')->group(function () {
    Route::get('/manage/user', [ManageUsersController::class, 'index'])->name('manageuser.index');
    Route::post('/manage/user', [ManageUsersController::class, 'store'])->name('manageuser.store');
    Route::get('/manage/user/create', [ManageUsersController::class, 'create'])->name('manageuser.create');
    Route::get('/manage/user/search', [ManageUsersController::class, 'search'])->name('manageuser.search');
    Route::get('/manage/user/{user}', [ManageUsersController::class, 'show'])->name('manageuser.show');
    Route::patch('/manage/user/{user}', [ManageUsersController::class, 'update'])->name('manageuser.update');
    Route::delete('/manage/user/{user}', [ManageUsersController::class, 'destroy'])->name('manageuser.destroy');
    Route::get('/manage/user/{user}/edit', [ManageUsersController::class, 'edit'])->name('manageuser.edit');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {

});

Route::middleware('auth')->group(function () {

});

require __DIR__.'/auth.php';
