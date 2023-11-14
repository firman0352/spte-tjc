<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusOrders extends Model
{
    use HasFactory;

    public function Orders()
    {
        return $this->hasMany(Orders::class);
    }

}
