<?php

namespace App\Http\Livewire\Dash\Keuangan;

use App\Models\PaymentHistory;
use Livewire\Component;

class Balance extends Component
{
    public $month;
    public $amount;

    public function render()
    {
        if ($this->month === null) {
            $this->month = date('Y-m');
        }

        $date = explode("-", $this->month);
        $this->amount = PaymentHistory::whereYear('created_at', $date[0])
            ->whereMonth('created_at', $date[1])->sum('payment_amount');

        return view('livewire.dash.keuangan.balance');
    }
}
