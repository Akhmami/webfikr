<?php

namespace App\Http\Livewire\Dash\Psb;

use App\Exports\PsbExport;
use App\Models\Year;
use LivewireUI\Modal\ModalComponent;

class Download extends ModalComponent
{
    public $tahun_pendaftaran;

    public function render()
    {
        return view('livewire.dash.psb.download', [
            'year' => Year::pluck('periode', 'periode')
        ]);
    }

    public function export()
    {
        return (new PsbExport($this->tahun_pendaftaran))->download('data-psb.xlsx');
    }
}
