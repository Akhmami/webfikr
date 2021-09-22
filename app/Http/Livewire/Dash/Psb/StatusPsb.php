<?php

namespace App\Http\Livewire\Dash\Psb;

use App\Models\StatusPsb as ModelsStatusPsb;
use Livewire\Component;

class StatusPsb extends Component
{
    public function render()
    {
        return view('livewire.dash.psb.status-psb', [
            'status_psb' => $this->status_psb = ModelsStatusPsb::get()
        ]);
    }
}
