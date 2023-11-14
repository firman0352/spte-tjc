<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusLog extends Model
{
    use HasFactory;

    protected $fillable = ['dokumen_customer_id', 'status_id','user_id','verifikasi_id'];

    public function status()
    {
        return $this->belongsTo(StatusDokumen::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}