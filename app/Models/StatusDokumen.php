<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class StatusDokumen extends Model
{
    use HasFactory;

    public const BELUM_VERIF = 1;
    public const MENUNGGU = 2;
    public const SUDAH_VERIF = 3;
    public const DITOLAK = 4;
    public const PERBAIKAN = 5;
    public const DALAM_PROSES = 6;
    public const INSPEKTUR_1 = 7;
    public const INSPEKTUR_2 = 8;

    public function DokumenCustomer(): HasMany
    {
        return $this->hasMany(DokumenCustomer::class);
    }
    
    public function Verifikasi(): HasMany
    {
        return $this->hasMany(Verifikasi::class);
    }
}
