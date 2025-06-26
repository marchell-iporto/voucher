<?php
namespace App\Helpers;

use Illuminate\Support\Facades\DB;

class VoucherHelper
{
    public static function generateNumber($type = 'PV')
    {
        $types = ['PV', 'RV', 'JV', 'CV', 'BV'];
        
        if (!in_array($type, $types)) {
            throw new \InvalidArgumentException("Invalid voucher type");
        }
        
        $month = date('m');
        $year = date('Y');
        $pattern = "{$type}-{$month}/{$year}-%";
        
        $lastNumber = DB::table('vouchers')
            ->where('voucher_number', 'LIKE', $pattern)
            ->orderBy('voucher_number', 'desc')
            ->value('voucher_number');
        
        $nextNumber = 1;
        if ($lastNumber) {
            $parts = explode('-', $lastNumber);
            $nextNumber = intval(end($parts)) + 1;
        }
        
        return "{$type}-{$month}/{$year}-" . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);
    }
}

