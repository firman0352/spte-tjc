<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\App;

class Pengajuan extends Model
{
    use HasFactory, HasUuids;
    protected $fillable = [
        'user_id',
        'status_id',
        'nama_produk',
        'jumlah',
        'dokumen',
    ];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function statusPengajuan(): BelongsTo
    {
        return $this->belongsTo(StatusPengajuan::class, 'status_id', 'id');
    }

    public function penawaranHarga(): HasOne
    {
        return $this->hasOne(PenawaranHarga::class);
    }
    public function getTempUrl($path)
    {
        $url = Storage::temporaryUrl(
            $path,
            now()->addMinutes(5)
        );

        return $url;
    }
}
