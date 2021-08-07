<?php

namespace App\Http\Livewire\Dash\Keuangan;

use LivewireUI\Modal\ModalComponent;
use App\Models\Billing;

class BillingEdit extends ModalComponent
{
    public $billing;
    // public $amount;
    public $datetime_expired;

    protected $rules = [
        'datetime_expired' => 'required|date_format:"Y-m-d H:i:s"'
    ];

    protected $messages = [
        'datetime_expired.required' => 'Tanggal kadaluarsa tidak boleh kosong',
        'datetime_expired.date_format' => 'Format tanggal tidak sesuai',
    ];

    public function mount(Billing $billing)
    {
        $this->billing = $billing;
        // $this->amount = $billing->amount;
        $this->datetime_expired = $billing->datetime_expired;
    }

    public function render()
    {
        return view('livewire.dash.keuangan.billing-edit');
    }

    public function update()
    {
        $validatedData = $this->validate();
        $this->billing->update($validatedData);

        $this->emit('openModal', 'alert-modal', [
            'emit' => 'closeBillingAlertModal',
            'title' => 'Billing Updated',
            'description' => 'Billing berhasil diupdate!'
        ]);
    }
}
