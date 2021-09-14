<?php

namespace App\Http\Livewire\Dash\Keuangan;

use App\Exports\KeuanganExport;
use LivewireUI\Modal\ModalComponent;

class ExportModal extends ModalComponent
{
    public $year;
    public $month;

    public function render()
    {
        return view('livewire.dash.keuangan.export-modal');
    }

    public function export()
    {
        return (new KeuanganExport($this->year, $this->month))->download('data-keuangan.xlsx');
    }
}
