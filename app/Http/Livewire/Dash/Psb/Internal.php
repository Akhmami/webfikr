<?php

namespace App\Http\Livewire\Dash\Psb;

use App\Models\Gelombang;
use Livewire\Component;

class Internal extends Component
{
    protected $listeners = [
        'gelombangIndex' => '$refresh'
    ];

    public function render()
    {
        return view('livewire.dash.psb.internal', [
            'data' => Gelombang::find(1)
        ]);
    }
}
