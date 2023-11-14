<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Pembayaran extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'order_id',
        'pembayaran_term1',
        'pembayaran_term2',
        'pembayaran_term3',
        'dokumen_bukti_term1',
        'dokumen_bukti_term2',
        'dokumen_bukti_term3',
        'invoice_term1',
        'invoice_term2',
        'invoice_term3',
    ];

    public function Orders()
    {
        return $this->belongsTo(Orders::class);
    }
}
