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
    public $tabActive = 'day';

    public function mount()
    {
        $this->date = Carbon::now()->subDays(1);
    }

    public function render()
    {
        $this->totalNominal = Billing::paid()
            ->where('updated_at', '>=', $this->date)->sum('trx_amount');

        $this->totalTransaksi = Billing::paid()
            ->where('updated_at', '>=', $this->date)->count();

        $this->punyaTagihan = User::has('activeBillers')->count();

        $this->tanpaTagihan = (User::where('status', 'santri')
            ->count() - $this->punyaTagihan);

        return view('livewire.dash.keuangan.report-tiles');
    }

    public function lastPeriode($days)
    {
        $this->date = Carbon::now()->subDays($days);
        $this->tabActive = 'day';
        if ($days == 7) {
            $this->tabActive = 'week';
        }

        if ($days == 30) {
            $this->tabActive = 'month';
        }
    }
}
