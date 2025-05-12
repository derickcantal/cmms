<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\manage\ManageUsersController;
use App\Http\Controllers\manage\ManageAccessController;
use App\Http\Controllers\manage\ManageDepartmentController;
use App\Http\Controllers\manage\ManageRequestersController;
use App\Http\Controllers\manage\ManageSuppliesController;
use App\Http\Controllers\manage\ManageWorkClassController;
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
    Route::get('/manage/access', [ManageAccessController::class, 'index'])->name('manageaccess.index');
    Route::post('/manage/access', [ManageAccessController::class, 'store'])->name('manageaccess.store');
    Route::get('/manage/access/create', [ManageAccessController::class, 'create'])->name('manageaccess.create');
    Route::get('/manage/access/search', [ManageAccessController::class, 'search'])->name('manageaccess.search');
    Route::get('/manage/access/{access}', [ManageAccessController::class, 'show'])->name('manageaccess.show');
    Route::patch('/manage/access/{access}', [ManageAccessController::class, 'update'])->name('manageaccess.update');
    Route::delete('/manage/access/{access}', [ManageAccessController::class, 'destroy'])->name('manageaccess.destroy');
    Route::get('/manage/access/{access}/edit', [ManageAccessController::class, 'edit'])->name('manageaccess.edit');

    Route::get('/manage/department', [ManageDepartmentController::class, 'index'])->name('managedepartment.index');
    Route::post('/manage/department', [ManageDepartmentController::class, 'store'])->name('managedepartment.store');
    Route::get('/manage/department/create', [ManageDepartmentController::class, 'create'])->name('managedepartment.create');
    Route::get('/manage/department/search', [ManageDepartmentController::class, 'search'])->name('managedepartment.search');
    Route::get('/manage/department/{department}', [ManageDepartmentController::class, 'show'])->name('managedepartment.show');
    Route::patch('/manage/department/{department}', [ManageDepartmentController::class, 'update'])->name('managedepartment.update');
    Route::delete('/manage/department/{department}', [ManageDepartmentController::class, 'destroy'])->name('managedepartment.destroy');
    Route::get('/manage/department/{department}/edit', [ManageDepartmentController::class, 'edit'])->name('managedepartment.edit');

    Route::get('/manage/requesters', [ManageRequestersController::class, 'index'])->name('managerequesters.index');
    Route::post('/manage/requesters', [ManageRequestersController::class, 'store'])->name('managerequesters.store');
    Route::get('/manage/requesters/create', [ManageRequestersController::class, 'create'])->name('managerequesters.create');
    Route::get('/manage/requesters/search', [ManageRequestersController::class, 'search'])->name('managerequesters.search');
    Route::get('/manage/requesters/{requesters}', [ManageRequestersController::class, 'show'])->name('managerequesters.show');
    Route::patch('/manage/requesters/{requesters}', [ManageRequestersController::class, 'update'])->name('managerequesters.update');
    Route::delete('/manage/requesters/{requesters}', [ManageRequestersController::class, 'destroy'])->name('managerequesters.destroy');
    Route::get('/manage/requesters/{requesters}/edit', [ManageRequestersController::class, 'edit'])->name('managerequesters.edit');

    Route::get('/manage/supplies', [ManageSuppliesController::class, 'index'])->name('managesupplies.index');
    Route::post('/manage/supplies', [ManageSuppliesController::class, 'store'])->name('managesupplies.store');
    Route::get('/manage/supplies/create', [ManageSuppliesController::class, 'create'])->name('managesupplies.create');
    Route::get('/manage/supplies/search', [ManageSuppliesController::class, 'search'])->name('managesupplies.search');
    Route::get('/manage/supplies/{supplies}', [ManageSuppliesController::class, 'show'])->name('managesupplies.show');
    Route::patch('/manage/supplies/{supplies}', [ManageSuppliesController::class, 'update'])->name('managesupplies.update');
    Route::delete('/manage/supplies/{supplies}', [ManageSuppliesController::class, 'destroy'])->name('managesupplies.destroy');
    Route::get('/manage/supplies/{supplies}/edit', [ManageSuppliesController::class, 'edit'])->name('managesupplies.edit');

    Route::get('/manage/user', [ManageUsersController::class, 'index'])->name('manageuser.index');
    Route::post('/manage/user', [ManageUsersController::class, 'store'])->name('manageuser.store');
    Route::get('/manage/user/create', [ManageUsersController::class, 'create'])->name('manageuser.create');
    Route::get('/manage/user/search', [ManageUsersController::class, 'search'])->name('manageuser.search');
    Route::get('/manage/user/{user}', [ManageUsersController::class, 'show'])->name('manageuser.show');
    Route::patch('/manage/user/{user}', [ManageUsersController::class, 'update'])->name('manageuser.update');
    Route::delete('/manage/user/{user}', [ManageUsersController::class, 'destroy'])->name('manageuser.destroy');
    Route::get('/manage/user/{user}/edit', [ManageUsersController::class, 'edit'])->name('manageuser.edit');

    Route::get('/manage/work/class', [ManageWorkClassController::class, 'index'])->name('manageworkclass.index');
    Route::post('/manage/work/class', [ManageWorkClassController::class, 'store'])->name('manageworkclass.store');
    Route::get('/manage/work/class/create', [ManageWorkClassController::class, 'create'])->name('manageworkclass.create');
    Route::get('/manage/work/class/search', [ManageWorkClassController::class, 'search'])->name('manageworkclass.search');
    Route::get('/manage/work/class/{workclass}', [ManageWorkClassController::class, 'show'])->name('manageworkclass.show');
    Route::patch('/manage/work/class/{workclass}', [ManageWorkClassController::class, 'update'])->name('manageworkclass.update');
    Route::delete('/manage/work/class/{workclass}', [ManageWorkClassController::class, 'destroy'])->name('manageworkclass.destroy');
    Route::get('/manage/work/class/{workclass}/edit', [ManageWorkClassController::class, 'edit'])->name('manageworkclass.edit');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {

});

Route::middleware('auth')->group(function () {

});

require __DIR__.'/auth.php';
