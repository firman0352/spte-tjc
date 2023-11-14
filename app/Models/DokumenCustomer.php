<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Storage;

class DokumenCustomer extends Model
{
    use HasFactory, HasUuids;
    protected $fillable = [
        'dokumen',
        'user_id',
        'status_id',
        'nama_pt',
        'alamat_pt',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(StatusDokumen::class);
    }

    public function statusLogs()
    {
        return $this->hasMany(StatusLog::class);
    }
    
    public function verifikasi(): HasOne
    {
        return $this->hasOne(Verifikasi::class);
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
