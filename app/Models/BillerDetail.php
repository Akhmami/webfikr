<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillerDetail extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama',
        'nominal'
    ];

    public function biller()
    {
        return $this->belongsTo(Biller::class);
    }

    public function costReduction()
    {
        return $this->hasOne(CostReduction::class);
    }
}
