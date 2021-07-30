<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, HasRoles, Search;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'username',
        'password',
        'bio',
        'gender',
        'birth_place',
        'birth_date'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $searchable = [
        'name',
        'username',
        'email'
    ];

    public function userDetail()
    {
        return $this->hasOne(UserDetail::class);
    }

    public function scopeSantri($query)
    {
        return $query->whereHas('userDetail', function ($q) {
            $q->status('santri');
        });
    }

    public function billers()
    {
        return $this->hasMany(Biller::class);
    }

    public function activeBillers()
    {
        return $this->billers()->where('is_active', 'Y');
    }

    public function billerSPP()
    {
        return $this->hasOne(Biller::class)
            ->where('type', 'SPP')
            ->where('is_active', 'Y')
            ->latest();
    }

    public function billerAnother()
    {
        return $this->billers()
            ->where('type', '<>', 'SPP')
            ->where('is_active', 'Y');
    }

    public function billings()
    {
        return $this->hasMany(Billing::class);
    }

    public function grades()
    {
        return $this->belongsToMany(Grade::class)->withTimestamps();
    }

    public function activeGrade()
    {
        return $this->grades()->wherePivot('is_active', 'Y')->latest('pivot_created_at')->limit(1);
    }

    public function setSpp()
    {
        return $this->hasOne(SetSpp::class);
    }

    public function spps()
    {
        return $this->hasMany(Spp::class);
    }

    public function latestSpp()
    {
        return $this->hasOne(Spp::class)->latestOfMany()->withDefault();
    }

    public function mobilePhones()
    {
        return $this->hasMany(MobilePhone::class);
    }

    public function firstMobilePhone()
    {
        return $this->hasOne(MobilePhone::class)->where('is_first', 'Y')->latestOfMany();
    }

    public function balanceUsages()
    {
        return $this->hasMany(BalanceUsage::class);
    }

    public function costReductions()
    {
        return $this->hasMany(CostReduction::class);
    }
}
