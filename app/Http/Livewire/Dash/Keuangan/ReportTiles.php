<?php

namespace App\Http\Livewire\Dash\Keuangan;

use App\Http\Livewire\User\Bill;
use Livewire\Component;
use App\Models\Billing;
use App\Models\User;
use Carbon\Carbon;

class ReportTiles extends Component
{
    public $periode;
    public $date;
    public $totalNominal;
    public $totalTransaksi;
    public $punyaTagihan;
    public $tanpaTagihan;

    public function mount()
    {
        $this->date = Carbon::now()->subDays(1);
    }

    public function render()
    {
        $this->totalNominal = Billing::paid()
            ->where('created_at', '>=', $this->date)->sum('trx_amount');

        $this->totalTransaksi = Billing::paid()
            ->where('created_at', '>=', $this->date)->count();

        $this->punyaTagihan = User::has('activeBillers')
            ->where('created_at', '>=', $this->date)->count();

        $this->tanpaTagihan = (User::where('status', 'santri')
            ->count() - $this->punyaTagihan);

        return view('livewire.dash.keuangan.report-tiles');
    }
}
