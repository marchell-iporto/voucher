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
Route::get('/recieveVoucher', [ReceiveVoucherController::class, 'index'])->name('recieve');

Route::get('/paymentVoucher', [PaymentVoucherController::class, 'index'])->name('payment');