<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use App\Jobs\UserActivity;

class Pembayaran extends Component
{
    public $payment;

    public function mount()
    {
        $this->payment = auth()->user()->billings()->active()->latest()->first();
        UserActivity::dispatch(auth()->user(), 'ke halaman pembayaran, menunggu pembayaran');
    }

    public function render()
    {
        return view('livewire.user.pembayaran');
    }

    public function batal()
    {
        $this->payment->update([
            'datetime_expired' => now()
        ]);

        return redirect()->to(route('user.pembayaran'));
    }
}
