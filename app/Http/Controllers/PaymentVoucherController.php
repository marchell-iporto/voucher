<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentVoucherController extends Controller
{
    public function index()
    {
        return view('paymentVoucher');
    }
}
