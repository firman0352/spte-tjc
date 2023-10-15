<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Jabatan extends Model
{
    use HasFactory;

    public function inspektur(): HasMany
    {
        return $this->hasMany(Inspektur::class);
    }

    protected $fillable = [
        'jabatan'
    ];
}
