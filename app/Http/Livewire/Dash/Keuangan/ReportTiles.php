<?php

namespace App\Http\Livewire\Dash\Keuangan;

use Livewire\Component;

class ReportTiles extends Component
{
    public $periode;

    public function render()
    {
        return view('livewire.dash.keuangan.report-tiles');
    }
}
