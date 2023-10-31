<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class PenawaranHarga extends Model
{
    use HasFactory, HasUuids;
    protected $fillable = [
        'pengajuan_id',
        'harga',
        'keterangan',
        'dokumen',
        'status_id',
    ];
    
    public function pengajuan()
    {
        return $this->belongsTo(Pengajuan::class);
    }
    public function status()
    {
        return $this->belongsTo(StatusPengajuan::class, 'status_id');
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
