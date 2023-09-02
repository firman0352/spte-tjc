<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class StatusDokumen extends Model
{
    use HasFactory;

    public const MENUNGGU = 1;
    public const SELESAI = 2;
    public const DITOLAK = 3;
    public const PERBAIKAN = 4;
    public const DALAM_PROSES = 5;
    public const INSPEKTUR_1 = 6;
    public const INSPEKTUR_2 = 7;

    public function DokumenCustomer(): HasMany
    {
        return $this->hasMany(DokumenCustomer::class);
    }
}
