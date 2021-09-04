<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubMenu extends Model
{
    use HasFactory;

    protected $fillable = ['menu_id', 'sub_name', 'sub_url'];

    public function menu()
    {
        return $this->belongTo(Menu::class);
    }
}
