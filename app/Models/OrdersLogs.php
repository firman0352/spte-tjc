<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdersLogs extends Model
{
    use HasFactory, HasUuids;
    protected $fillable = [
        'order_id',
        'status_order_id',
        'user_id',
    ];

    public function Orders()
    {
        return $this->belongsTo(Orders::class);
    }   

    public function StatusOrders()
    {
        return $this->belongsTo(StatusOrders::class);
    }

    public function User()
    {
        return $this->belongsTo(User::class);
    }
}
