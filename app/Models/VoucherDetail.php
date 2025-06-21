<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VoucherDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'voucher_id',
        'account_number',
        'account_name',
        'amount',
        'line_number',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'line_number' => 'integer',
    ];

    /**
     * Get the voucher that owns the detail.
     */
    public function voucher(): BelongsTo
    {
        return $this->belongsTo(Voucher::class);
    }

    /**
     * Get formatted amount.
     */
    public function getFormattedAmountAttribute(): string
    {
        return number_format($this->amount, 0, ',', '.');
    }

    /**
     * Check if this is a debit entry (amount > 0).
     */
    public function isDebit(): bool
    {
        return $this->amount > 0;
    }

    /**
     * Check if this is a credit entry (amount = 0 or represents credit side).
     */
    public function isCredit(): bool
    {
        return $this->amount == 0;
    }

    /**
     * Get entry type (Debit/Credit).
     */
    public function getEntryType(): string
    {
        return $this->isDebit() ? 'Debit' : 'Credit';
    }

    /**
     * Scope to get debit entries.
     */
    public function scopeDebit($query)
    {
        return $query->where('amount', '>', 0);
    }

    /**
     * Scope to get credit entries.
     */
    public function scopeCredit($query)
    {
        return $query->where('amount', '=', 0);
    }

    /**
     * Boot method.
     */
    protected static function boot()
    {
        parent::boot();

        // Auto set line number when creating
        static::creating(function ($detail) {
            if (empty($detail->line_number)) {
                $maxLine = static::where('voucher_id', $detail->voucher_id)->max('line_number');
                $detail->line_number = ($maxLine ?? 0) + 1;
            }
        });

        // Update voucher total when detail is saved/deleted
        static::saved(function ($detail) {
            $detail->voucher->updateTotal();
        });

        static::deleted(function ($detail) {
            $detail->voucher->updateTotal();
        });
    }
}