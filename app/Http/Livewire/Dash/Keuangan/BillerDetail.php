<?php

namespace App\Http\Livewire\Dash\Keuangan;

use LivewireUI\Modal\ModalComponent;
use App\Models\Biller;

class BillerDetail extends ModalComponent
{
    public $biller;

    public function mount($biller)
    {
        $this->biller = Biller::with([
            'user', 'billerDetails'
        ])->findOrFail($biller);
    }

    public function render()
    {
        return view('livewire.dash.keuangan.biller-detail');
    }


}
