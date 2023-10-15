<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Support\Facades\Storage;


class Verifikasi extends Model
{
    use HasFactory, HasUuids;
    protected $fillable = [
        'dokumen_customer_id',
        'inspektur_id',
        'inspektur2_id',
        'status_id',
        'tanggal_mulai',
        'tanggal_selesai',
        'comment',
        'rejecting_inspektur'
    ];

    public function dokumenCustomer(): BelongsTo
    {
        return $this->belongsTo(DokumenCustomer::class, 'dokumen_customer_id', 'id');
    }

    public function inspektur(): BelongsTo
    {
        return $this->belongsTo(Inspektur::class, 'inspektur_id', 'id');
    }

    public function inspektur2(): BelongsTo
    {
        return $this->belongsTo(Inspektur::class, 'inspektur2_id', 'id');
    }

    public function statusDokumen(): BelongsTo
    {
        return $this->belongsTo(StatusDokumen::class, 'status_id', 'id');
    }
}
