<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Voucher extends Model
{
    use HasFactory;

    protected $fillable = [
        'voucher_number',
        'reference_number',
        'date',
        'from_to',
        'description',
        'bank_code',
        'bank_name',
        'terbilang',
        'total_amount',
        'type',
    ];

    protected $casts = [
        'date' => 'date',
        'total_amount' => 'decimal:2',
    ];

    const VOUCHER_TYPES = [
        'PV' => 'Payment Voucher',
        'RV' => 'Receipt Voucher',
        'JV' => 'Journal Voucher',
        'CV' => 'Cash Voucher',
        'BV' => 'Bank Voucher'
    ];

    /**
     * Get the details for the voucher.
     */
    public function details(): HasMany
    {
        return $this->hasMany(VoucherDetail::class)->orderBy('line_number');
    }

    /**
     * Scope a query to only include receive vouchers.
     */
    public function scopeReceive($query)
    {
        return $query->where('type', 'receive');
    }

    /**
     * Scope a query to only include payment vouchers.
     */
    public function scopePayment($query)
    {
        return $query->where('type', 'payment');
    }

    /**
     * Check if voucher is receive type.
     */
    public function isReceive(): bool
    {
        return $this->type === 'receive';
    }

    /**
     * Check if voucher is payment type.
     */
    public function isPayment(): bool
    {
        return $this->type === 'payment';
    }

    /**
     * Generate voucher number.
     */
    public static function generateVoucherNumber($type = 'PV')
    {
        if (!array_key_exists($type, self::VOUCHER_TYPES)) {
            throw new \InvalidArgumentException("Invalid voucher type: {$type}");
        }

        $currentMonth = date('m');
        $currentYear = date('Y');
        $pattern = "{$type}-{$currentMonth}/{$currentYear}-%";

        $lastVoucher = self::where('voucher_number', 'LIKE', $pattern)
            ->orderBy('voucher_number', 'desc')
            ->first();

        $nextNumber = 1;
        if ($lastVoucher) {
            $parts = explode('-', $lastVoucher->voucher_number);
            $nextNumber = intval(end($parts)) + 1;
        }

        $formattedNumber = str_pad($nextNumber, 3, '0', STR_PAD_LEFT);
        return "{$type}-{$currentMonth}/{$currentYear}-{$formattedNumber}";
    }

    public static function getVoucherTypes()
    {
        return self::VOUCHER_TYPES;
    }

    /**
     * Get formatted amount.
     */
    public function getFormattedAmountAttribute(): string
    {
        return number_format($this->total_amount, 0, ',', '.');
    }

    /**
     * Get type label.
     */
    public function getTypeLabel(): string
    {
        return $this->type === 'receive' ? 'Receive Voucher' : 'Payment Voucher';
    }

    /**
     * Calculate total amount from details.
     */
    public function calculateTotal(): float
    {
        return $this->details()->sum('amount');
    }

    /**
     * Update total amount based on details.
     */
    public function updateTotal(): bool
    {
        $this->total_amount = $this->calculateTotal();
        return $this->save();
    }

    /**
     * Get all receive vouchers.
     */
    public static function getReceiveVouchers()
    {
        return static::receive()->with('details')->orderBy('date', 'desc')->get();
    }

    /**
     * Get all payment vouchers.
     */
    public static function getPaymentVouchers()
    {
        return static::payment()->with('details')->orderBy('date', 'desc')->get();
    }

    /**
     * Get vouchers by date range.
     */
    public static function getByDateRange($startDate, $endDate, $type = null)
    {
        $query = static::whereBetween('date', [$startDate, $endDate]);

        if ($type) {
            $query->where('type', $type);
        }

        return $query->with('details')->orderBy('date', 'desc')->get();
    }

    /**
     * Search vouchers.
     */
    public static function search($keyword)
    {
        return static::where(function ($query) use ($keyword) {
            $query->where('voucher_number', 'like', "%{$keyword}%")
                ->orWhere('from_to', 'like', "%{$keyword}%")
                ->orWhere('description', 'like', "%{$keyword}%")
                ->orWhere('reference_number', 'like', "%{$keyword}%");
        })->with('details')->orderBy('date', 'desc')->get();
    }

    /**
     * Get voucher statistics.
     */
    public static function getStats()
    {
        return [
            'total_vouchers' => static::count(),
            'receive_vouchers' => static::receive()->count(),
            'payment_vouchers' => static::payment()->count(),
            'total_receive_amount' => static::receive()->sum('total_amount'),
            'total_payment_amount' => static::payment()->sum('total_amount'),
            'latest_voucher' => static::latest()->first(),
        ];
    }

    /**
     * Duplicate voucher with new number.
     */
    public function duplicate(): static
    {
        $newVoucher = $this->replicate();
        $newVoucher->voucher_number = static::generateVoucherNumber($this->type);
        $newVoucher->date = now()->toDateString();
        $newVoucher->save();

        // Duplicate details
        foreach ($this->details as $detail) {
            $newDetail = $detail->replicate();
            $newDetail->voucher_id = $newVoucher->id;
            $newDetail->save();
        }

        return $newVoucher;
    }

    /**
     * Get formatted date.
     */
    public function getFormattedDateAttribute(): string
    {
        return $this->date->format('d M Y');
    }

    /**
     * Boot method.
     */
    protected static function boot()
    {
        parent::boot();

        // Auto generate voucher number when creating
        static::creating(function ($voucher) {
            if (empty($voucher->voucher_number)) {
                $voucher->voucher_number = static::generateVoucherNumber($voucher->type);
            }
        });

        // Delete related details when voucher is deleted
        static::deleting(function ($voucher) {
            $voucher->details()->delete();
        });
    }
}
