<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PaymentVoucherController;
use App\Http\Controllers\ReceiveVoucherController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/dashboard/statistics', [DashboardController::class, 'getStatistics'])->name('dashboard.statistics');
Route::get('/dashboard/export', [DashboardController::class, 'exportExcel'])->name('dashboard.export');
Route::delete('/dashboard/voucher/{id}', [DashboardController::class, 'deleteVoucher'])->name('dashboard.delete.voucher');
Route::delete('/dashboard/voucher-detail/{id}', [DashboardController::class, 'deleteVoucherDetail'])->name('dashboard.delete.detail');
Route::get('/dashboard/voucher/{id}', [DashboardController::class, 'getVoucherData'])->name('dashboard.get.voucher');
Route::get('/dashboard/search', [DashboardController::class, 'searchVouchers'])->name('dashboard.search');
Route::get('/receive-voucher/{id}/edit', [ReceiveVoucherController::class, 'edit'])->name('vouchers.edit');
Route::put('/receive-voucher/{id}', [ReceiveVoucherController::class, 'update'])->name('vouchers.update');
Route::get('/recieveVoucher', [ReceiveVoucherController::class, 'index'])->name('recieve');
Route::post('receiveVoucher/store', [ReceiveVoucherController::class, 'store'])->name('recieve.store');


Route::get('/paymentVoucher', [PaymentVoucherController::class, 'index'])->name('payment');
Route::get('/payment-voucher/{id}/edit', [ReceiveVoucherController::class, 'edit'])->name('paymentvouchers.edit');
Route::put('/payment-voucher/{id}', [ReceiveVoucherController::class, 'update'])->name('paymentvouchers.update');
Route::post('paymentVoucher/store', [ReceiveVoucherController::class, 'store'])->name('payment.store');
