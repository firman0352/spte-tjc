<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use  HasFactory, Notifiable, HasUuids, HasApiTokens;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'role_id',
        'password',
        'phone',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    //relationship
    public function roles(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function statusLogs()
    {
        return $this->hasMany(StatusLog::class);
    }

    public function inspektur(): HasOne
    {
        return $this->hasOne(Inspektur::class);
    }

    public function DokumenCustomer(): HasOne
    {
        return $this->hasOne(DokumenCustomer::class);
    }

    public function Orders(): HasMany
    {
        return $this->hasMany(Orders::class);
    }
    //end relationship

    public function hasRole($role, $inspekturJabatan = null)
    {
        switch ($role) {
            case 'customer':
                if ($this->role_id == Role::IS_CUSTOMER) {
                    return true;
                }
                return false;
            case 'admin':
                if ($this->role_id == Role::IS_ADMIN) {
                    return true;
                }
                return false;
            case 'inspektur':
                if ($this->role_id == Role::IS_INSPEKTUR) {
                    if ($inspekturJabatan === null) {
                        return true;
                    } elseif ($this->inspektur->jabatan_id == $inspekturJabatan) {
                        return true;
                    }
                    return false;
                }
                return false;  
            default:
                return false;
        }
    }

    public function roleName()
    {
        switch ($this->role_id) {
            case Role::IS_CUSTOMER:
                return 'customer';
            case Role::IS_ADMIN:
                return 'admin';
            case Role::IS_INSPEKTUR:
                return 'inspektur';
            default:
                return 'customer';
        }
    }
}
