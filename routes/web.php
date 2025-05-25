<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\manage\ManageUsersController;
use App\Http\Controllers\manage\ManageAccessController;
use App\Http\Controllers\manage\ManageDepartmentController;
use App\Http\Controllers\manage\ManageRequestersController;
use App\Http\Controllers\manage\ManageSuppliesController;
use App\Http\Controllers\manage\ManageWorkClassController;
use App\Http\Controllers\manage\ManageTempUsersController;
use App\Http\Controllers\manage\ManageMyProfileController;
use App\Http\Controllers\transaction\TransactionWorkOrderController;
use App\Http\Controllers\transaction\TransactionSupplyDeliveryController;
use App\Http\Controllers\transaction\TransactionWOSupplyController;
use App\Http\Controllers\reports\ReportHistoryWorkOrderController;
use App\Http\Controllers\dashboard\DashboardOverviewController;


use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {

//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
     Route::get('/dashboard', [DashboardOverviewController::class, 'index'])->name('dashboard');
     Route::get('/events', [DashboardOverviewController::class, 'getevents']);
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

    Route::get('/manage/users/temp', [ManageTempUsersController::class, 'index'])->name('managetempusers.index');
    Route::post('/manage/users/temp', [ManageTempUsersController::class, 'store'])->name('managetempusers.store');
    Route::get('/manage/users/temp/create', [ManageTempUsersController::class, 'create'])->name('managetempusers.create');
    Route::get('/manage/users/temp/search', [ManageTempUsersController::class, 'search'])->name('managetempusers.search');
    Route::get('/manage/users/temp/{tempusers}', [ManageTempUsersController::class, 'show'])->name('managetempusers.show');
    Route::patch('/manage/users/temp/{tempusers}', [ManageTempUsersController::class, 'update'])->name('managetempusers.update');
    Route::delete('/manage/users/temp/{tempusers}', [ManageTempUsersController::class, 'destroy'])->name('managetempusers.destroy');
    Route::get('/manage/users/temp/{tempusers}/edit', [ManageTempUsersController::class, 'edit'])->name('managetempusers.edit');

    Route::get('/manage/myprofile', [ManageMyProfileController::class, 'index'])->name('managemyprofile.index');
    Route::post('/manage/myprofile', [ManageMyProfileController::class, 'store'])->name('managemyprofile.store');
    Route::get('/manage/myprofile/create', [ManageMyProfileController::class, 'create'])->name('managemyprofile.create');
    Route::get('/manage/myprofile/search', [ManageMyProfileController::class, 'search'])->name('managemyprofile.search');
    Route::get('/manage/myprofile/{myprofile}', [ManageMyProfileController::class, 'show'])->name('managemyprofile.show');
    Route::patch('/manage/myprofile/{myprofile}', [ManageMyProfileController::class, 'update'])->name('managemyprofile.update');
    Route::delete('/manage/myprofile/{myprofile}', [ManageMyProfileController::class, 'destroy'])->name('managemyprofile.destroy');
    Route::get('/manage/myprofile/{myprofile}/edit', [ManageMyProfileController::class, 'edit'])->name('managemyprofile.edit');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/transaction/work/order', [TransactionWorkOrderController::class, 'index'])->name('transactionworkorder.index');
    Route::post('/transaction/work/order/approval/{workorder}', [TransactionWorkOrderController::class, 'approve'])->name('transactionworkorder.approve');
    Route::post('/transaction/work/order/verify/{workorder}', [TransactionWorkOrderController::class, 'verify'])->name('transactionworkorder.verify');
    Route::patch('/transaction/work/order/end/{workorder}', [TransactionWorkOrderController::class, 'cwork'])->name('transactionworkorder.cwork');
    Route::post('/transaction/work/order', [TransactionWorkOrderController::class, 'store'])->name('transactionworkorder.store');
    Route::get('/transaction/work/order/create', [TransactionWorkOrderController::class, 'create'])->name('transactionworkorder.create');
    Route::get('/transaction/work/order/search', [TransactionWorkOrderController::class, 'search'])->name('transactionworkorder.search');
    Route::get('/transaction/work/order/{workorder}', [TransactionWorkOrderController::class, 'show'])->name('transactionworkorder.show');
    Route::patch('/transaction/work/order/{workorder}', [TransactionWorkOrderController::class, 'update'])->name('transactionworkorder.update');
    Route::delete('/transaction/work/order/{workorder}', [TransactionWorkOrderController::class, 'destroy'])->name('transactionworkorder.destroy');
    Route::get('/transaction/work/order/{workorder}/edit', [TransactionWorkOrderController::class, 'edit'])->name('transactionworkorder.edit');
    Route::post('/transaction/work/order/send/mail', [TransactionWorkOrderController::class, 'mailwocreated'])->name('transactionworkorder.mailwocreated');

    Route::get('/transaction/work/order/{woid}/supply/', [TransactionWOSupplyController::class, 'index'])->name('transactionwosupply.index');
    Route::get('/transaction/work/order/{woid}/supply/store', [TransactionWOSupplyController::class, 'store'])->name('transactionwosupply.store');
    Route::get('/transaction/work/order/{woid}/supply/create', [TransactionWOSupplyController::class, 'create'])->name('transactionwosupply.create');
    Route::get('/transaction/work/order/supply/search', [TransactionWOSupplyController::class, 'search'])->name('transactionwosupply.search');
    Route::get('/transaction/work/order/supply/{wosupply}', [TransactionWOSupplyController::class, 'show'])->name('transactionwosupply.show');
    Route::patch('/transaction/work/order/supply/{wosupply}', [TransactionWOSupplyController::class, 'update'])->name('transactionwosupply.update');
    Route::delete('/transaction/work/order/supply/{wosupply}', [TransactionWOSupplyController::class, 'destroy'])->name('transactionwosupply.destroy');
    Route::get('/transaction/work/order/supply/{wosupply}/edit', [TransactionWOSupplyController::class, 'edit'])->name('transactionwosupply.edit');

    Route::get('/transaction/supply/delivery', [TransactionSupplyDeliveryController::class, 'index'])->name('transactionsupplydelivery.index');
    Route::post('/transaction/supply/delivery', [TransactionSupplyDeliveryController::class, 'store'])->name('transactionsupplydelivery.store');
    Route::get('/transaction/supply/delivery/create', [TransactionSupplyDeliveryController::class, 'create'])->name('transactionsupplydelivery.create');
    Route::get('/transaction/supply/delivery/search', [TransactionSupplyDeliveryController::class, 'search'])->name('transactionsupplydelivery.search');
    Route::get('/transaction/supply/delivery/{supplydelivery}', [TransactionSupplyDeliveryController::class, 'show'])->name('transactionsupplydelivery.show');
    Route::patch('/transaction/supply/delivery/{supplydelivery}', [TransactionSupplyDeliveryController::class, 'update'])->name('transactionsupplydelivery.update');
    Route::delete('/transaction/supply/delivery/{supplydelivery}', [TransactionSupplyDeliveryController::class, 'destroy'])->name('transactionsupplydelivery.destroy');
    Route::get('/transaction/supply/delivery/{supplydelivery}/edit', [TransactionSupplyDeliveryController::class, 'edit'])->name('transactionsupplydelivery.edit');
});

Route::middleware('auth')->group(function () {
    Route::get('/reports/history/work/order', [ReportHistoryWorkOrderController::class, 'index'])->name('reportshistoryworkorder.index');
    Route::get('/reports/history/work/search', [ReportHistoryWorkOrderController::class, 'search'])->name('reportshistoryworkorder.search');
    Route::get('/reports/history/work/{supplydelivery}/order', [ReportHistoryWorkOrderController::class, 'show'])->name('reportshistoryworkorder.show');
});

require __DIR__.'/auth.php';
