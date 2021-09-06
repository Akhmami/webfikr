<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use App\Models\Biller;

class Bill extends Component
{
    public $total_amount;
    public $description;

    protected $listeners = [
        'closeBalanceAlertModal' => 'indexBill'
    ];

    public function render()
    {
        $user = auth()->user();
        $bill_spp = $user->billerSPP;
        $bill_another = $user->billerAnother;
        $keringanan = ($bill_spp->hitung_keringanan ?? 0) + ($bill_another->sum('hitung_keringanan') ?? 0);
        $spp = ($bill_spp->amount ?? 0) - ($bill_spp->cumulative_payment_amount ?? 0);
        $another = $bill_another->sum('amount') - $bill_another->sum('cumulative_payment_amount');
        $this->total_amount = $spp + $another - $keringanan;
        $this->description = 'Tagihan belum tersedia';

        if (!empty($bill_spp) && $bill_another->sum('amount') > 0) {
            $this->description = $bill_spp->description . ' dan lainnya';
        }

        if (empty($bill_spp) && $bill_another->sum('amount') > 0) {
            $this->description = 'Tagihan yang belum dibayar';
        }

        if (!empty($bill_spp) && $bill_another->sum('amount') < 1) {
            $this->description = $bill_spp->description;
        }

        return view('livewire.user.bill');
    }

    public function indexBill()
    {
        # code...
    }
}
