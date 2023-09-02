<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokumenCustomer extends Model
{
    use HasFactory, HasUuids;
    protected $fillable = [
        'dokumen',
        'user_id',
        'status_id',
        'nama_pt',
        'alamat_pt',
        'no_telp'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function status()
    {
        return $this->belongsTo(StatusDokumen::class);
    }
}
