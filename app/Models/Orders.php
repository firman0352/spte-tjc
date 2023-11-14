<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'user_id',
        'penawaran_id',
        'status_order_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function penawaran()
    {
        return $this->belongsTo(PenawaranHarga::class);
    }

    public function status_order()
    {
        return $this->belongsTo(StatusOrders::class);
    }

    public function kontrak()
    {
        return $this->hasOne(Kontrak::class, 'order_id', 'id');
    }

    public function pembayaran()
    {
        return $this->hasOne(Pembayaran::class, 'order_id', 'id');
    }

    public function progress()
    {
        return $this->hasOne(Progress::class, 'order_id', 'id');
    }
}
