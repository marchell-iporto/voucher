<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReceiveVoucherController extends Controller
{
     public function index(){
        return view('receiveVoucher');
    }
}
