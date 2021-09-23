<?php

namespace App\Http\Livewire\Dash\Psb;

use App\Models\User;
use App\Models\Year;
use Livewire\Component;

class Menu extends Component
{
    public $pendaftar;

    public function render()
    {
        $year = Year::active()->first();
        $this->pendaftar = User::where('tahun_pendaftaran', $year->periode)->count();

        return view('livewire.dash.psb.menu');
    }
}
