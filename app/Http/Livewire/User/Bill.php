<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use App\Models\Biller;

class Bill extends Component
{
    public $total_amount;
    public $description;

    public function render()
    {
        $bill_spp = auth()->user()->billerSPP;
        $bill_another = auth()->user()->billerAnother;
        $spp = ($bill_spp->amount ?? 0) - ($bill_spp->cumulative_payment_amount ?? 0);
        $another = $bill_another->sum('amount') - $bill_another->sum('cumulative_payment_amount');
        $this->total_amount = $spp + $another;
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
}
