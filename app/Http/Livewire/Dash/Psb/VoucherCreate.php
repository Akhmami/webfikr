<?php

namespace App\Http\Livewire\Dash\Psb;

use App\Models\Voucher;
use LivewireUI\Modal\ModalComponent;

class VoucherCreate extends ModalComponent
{
    public $name;
    public $type = 'decimal';
    public $value;
    public $quota;
    public $datetime_expired;

    protected $rules = [
        'name' => 'required',
        'value' => 'required',
        'quota' => 'required',
        'datetime_expired' => 'required'
    ];

    public function render()
    {
        return view('livewire.dash.psb.voucher-create');
    }

    public function store()
    {
        $validatedData = $this->validate();
        $validatedData['type'] = $this->type;
        Voucher::create($validatedData);

        $this->closeModal();
        $this->emit('voucherIndex');

        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',
            'title' => 'Created!',
            'text' => 'Voucher Berhasil Dibuat',
        ]);
    }
}
