<?php

namespace App\Http\Livewire\Dash\Psb;

use App\Models\Voucher;
use LivewireUI\Modal\ModalComponent;

class VoucherEdit extends ModalComponent
{
    public $name;
    public $value;
    public $quota;
    public $datetime_expired;
    public $voucher;

    protected $rules = [
        'name' => 'required',
        'value' => 'required',
        'quota' => 'required',
        'datetime_expired' => 'required'
    ];

    public function mount(Voucher $voucher)
    {
        $this->voucher = $voucher;
        $this->name = $voucher->name;
        $this->value = $voucher->value;
        $this->quota = $voucher->quota;
        $this->datetime_expired = $voucher->datetime_expired;
    }

    public function render()
    {
        return view('livewire.dash.psb.voucher-edit');
    }

    public function update()
    {
        $validatedData = $this->validate();
        $this->voucher->update($validatedData);

        $this->closeModal();
        $this->emit('voucherIndex');

        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',
            'title' => 'Updated!',
            'text' => 'Voucher Berhasil Diupdate',
        ]);
    }
}
