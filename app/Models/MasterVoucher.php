<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterVoucher extends Model
{
    use HasFactory;
    protected $table = 'master_account';
    protected $fillable = [
        'nomor_akun',
        'nama_akun',
    ];

    // Jika tidak pakai timestamps (created_at, updated_at)
    public $timestamps = false;
}
