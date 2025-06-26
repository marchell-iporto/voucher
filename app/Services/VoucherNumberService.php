<?php

// ============================================
// OPSI 1: SERVICE CLASS (RECOMMENDED)
// ============================================

// File: app/Services/VoucherNumberService.php
namespace App\Services;

use Illuminate\Support\Facades\DB;
use Exception;

class VoucherNumberService
{
    const VOUCHER_TYPES = [
        'PV' => 'Payment Voucher',
        'RV' => 'Receipt Voucher', 
        'JV' => 'Journal Voucher',
        'CV' => 'Cash Voucher',
        'BV' => 'Bank Voucher'
    ];
    
    public function generateVoucherNumber($type = 'PV')
    {
        if (!array_key_exists($type, self::VOUCHER_TYPES)) {
            throw new \InvalidArgumentException("Invalid voucher type: {$type}");
        }
        
        $currentMonth = date('m');
        $currentYear = date('Y');
        
        $lastNumber = $this->getLastVoucherNumberByType($type, $currentMonth, $currentYear);
        $nextNumber = $lastNumber + 1;
        $formattedNumber = str_pad($nextNumber, 3, '0', STR_PAD_LEFT);
        
        return "{$type}-{$currentMonth}/{$currentYear}-{$formattedNumber}";
    }
    
    private function getLastVoucherNumberByType($type, $month, $year)
    {
        $pattern = "{$type}-{$month}/{$year}-%";
        
        $lastVoucher = DB::table('vouchers')
            ->where('voucher_number', 'LIKE', $pattern)
            ->orderBy('voucher_number', 'desc')
            ->first();
        
        if ($lastVoucher) {
            $parts = explode('-', $lastVoucher->voucher_number);
            return intval(end($parts));
        }
        
        return 0;
    }
    
    public function getVoucherTypes()
    {
        return self::VOUCHER_TYPES;
    }
}
