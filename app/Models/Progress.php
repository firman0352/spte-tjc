<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Progress extends Model
{
    use HasFactory, HasUuids;
    protected $fillable = [
        'order_id',
        'in_production',
        'product_finished',
        'product_packing',
        'product_container',
        'lab_test_document',
        'shipping_document',
        'bill_of_lading',
    ];

    public function Orders()
    {
        return $this->belongsTo(Orders::class);
    }
}
