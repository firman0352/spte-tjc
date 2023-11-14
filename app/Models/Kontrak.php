<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kontrak extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'order_id',
        'kontrak_file',
        'status',
    ];

    protected $enumStatus = [
        'signed_by_exporter' => 1,
        'signed_by_importer' => 2,
    ];

    public function getStatusAttribute($value)
    {
        return array_flip($this->enumStatus)[$value];
    }

    public function setStatusAttribute($value)
    {
        $this->attributes['status'] = $this->enumStatus[$value];
    }

    public function Orders()
    {
        return $this->belongsTo(Orders::class);
    }
}
