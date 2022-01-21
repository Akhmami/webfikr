<?php

namespace App\Models;

use App\Traits\Search;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Activitylog\ActivitylogServiceProvider;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, HasRoles, Search;

    // Optional properties
    protected $search = ['name', 'username', 'email'];

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
        'birth_date',
        'status_psb_id',
        'lokasi_test_id',
        'medical_check_id',
        'gelombang_id',
        'jalur_masuk',
        'tahun_pendaftaran',
        'tahun_ajaran',
        'status',
        'questionnaire_psb'
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

    // public function setSlugAttribute($value)
    // {
    //     if (static::whereSlug($slug = str_slug($value))->exists()) {
    //         $slug = $slug . '-' . date('s');
    //     }
    //     $this->attributes['slug'] = $slug;
    // }

    // public function setUsernameAttribute($value)
    // {
    //     if (static::whereUsername($value)->exists()) {
    //         $value = is_int($value) === 1 ? $value + 1 : $value;
    //     }

    //     $this->attributes['username'] = $value;
    // }

    public function getVerifiedAttribute($value)
    {
        return is_null($this->email_verified_at) ? false : true;
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function activities()
    {
        return $this->morphMany(
            ActivitylogServiceProvider::determineActivityModel(),
            'causer'
        )->latest('id')->limit(8);
    }

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
            ->latest('id');
    }

    public function billerAnother()
    {
        return $this->billers()
            ->where('type', '<>', 'SPP')
            ->where('is_active', 'Y');
    }

    public function billerPsb()
    {
        return $this->hasOne(Biller::class)->where('type', 'PSB')->latest('id');
    }

    public function billerDupsb()
    {
        return $this->hasOne(Biller::class)->where('type', 'DUPSB')->latest('id');
    }

    public function billings()
    {
        return $this->hasMany(Billing::class);
    }

    public function paymentHistories()
    {
        return $this->hasMany(PaymentHistory::class);
    }

    public function clothes()
    {
        return $this->hasMany(Clothes::class);
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
        return $this->hasOne(MobilePhone::class)->where('is_first', 'Y');
    }

    public function balance()
    {
        return $this->hasOne(Balance::class)->latest('id');
    }

    public function balanceUsages()
    {
        return $this->hasMany(BalanceUsage::class);
    }

    public function costReductions()
    {
        return $this->hasMany(CostReduction::class);
    }

    public function files()
    {
        return $this->hasMany(UserFile::class);
    }

    public function getTempatTanggalLahirAttribute()
    {
        return $this->birth_place . ', ' . tanggal($this->birth_date);
    }

    public function vouchers()
    {
        return $this->belongsToMany(Voucher::class);
    }

    public function statusPsb()
    {
        return $this->belongsTo(StatusPsb::class);
    }

    public function medicalCheck()
    {
        return $this->belongsTo(MedicalCheck::class);
    }

    public function gelombang()
    {
        return $this->belongsTo(Gelombang::class);
    }

    public function lokasiTest()
    {
        return $this->belongsTo(LokasiTest::class);
    }

    public function questionnaires()
    {
        return $this->hasMany(Questionnaire::class);
    }
}
