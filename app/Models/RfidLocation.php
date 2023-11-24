<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RfidLocation extends Model
{
    use HasFactory;
    protected $fillable = [
        'rfid_tag',
        'location',
        'timestamp',
    ];

    public function verifikasi()
    {
        return $this->belongsTo(Verifikasi::class, 'rfid_tag', 'rfid_tag');
    }
}
