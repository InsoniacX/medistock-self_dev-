<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Batch extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'medicine_id',
        'batch_number',
        'quantity',
        'expiry_date',
    ];

    protected $casts = [
        'expiry_date' => 'date',
    ];

    // Relasi ke obat
    public function medicine()
    {
        return $this->belongsTo(Medicines::class);
    }


    // Cek apakah batch sudah kadaluarsa
    public function isExpired()
    {
        return $this->expiry_date->isPast();
    }

    // Cek apakah batch akan kadaluarsa dalam 3 bulan ke depan
    public function willExpireSoon()
    {
        return !$this->isExpired() && $this->expiry_date->lte(Carbon::now()->addMonths(3));
    }

    // Cek apakah stok batch menipis (misal < 30)
    public function isLowStock()
    {
        return $this->quantity < 30 && $this->quantity > 0;
    }
}
