<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use App\Models\Biller;

class Bill extends Component
{
    public $total_amount;
    public $description;

    protected $listeners = [
        'closeBalanceAlertModal' => '$refresh'
    ];

    public function render()
    {
        $user = auth()->user();
        $amount = $user->billers()->active()->sum('amount');
        $cpa = $user->billers()->active()->sum('cumulative_payment_amount');
        $cost_reduction = $user->billers()->active()->sum('cost_reduction');
        $balance_used = $user->billers()->active()->sum('balance_used');
        $bill_spp = $user->billerSPP;
        $bill_another = $user->billerAnother;
        $this->total_amount = $amount - ($cpa + $cost_reduction + $balance_used);
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

        return view('livewire.user.bill', [
            'user' => $user
        ]);
    }
}
