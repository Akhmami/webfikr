<?php

namespace App\Http\Livewire\Dash\Keuangan;

use LivewireUI\Modal\ModalComponent;
use App\Models\Balance;

class EditSaldo extends ModalComponent
{
    public $balance;
    public $current_amount;

    public function mount(Balance $balance)
    {
        $this->balance = $balance;
        $this->current_amount = $balance->current_amount;
    }

    public function render()
    {
        return view('livewire.dash.keuangan.edit-saldo');
    }

    public function update()
    {
        $validated = $this->validate(['current_amount' => 'required']);

        $this->balance->update($validated);

        $this->emit('openModal', 'alert-modal', [
            'status' => 'success',
            'emit' => 'closeAlertBalance',
            'title' => 'Saldo Terupdate!',
            'description' => 'Jumlah saldo berhasil diupdate.'
        ]);
    }
}
