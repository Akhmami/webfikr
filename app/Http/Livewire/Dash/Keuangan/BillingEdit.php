<?php

namespace App\Http\Livewire\Dash\Keuangan;

use LivewireUI\Modal\ModalComponent;
use App\Models\Billing;

class BillingEdit extends ModalComponent
{
    public $billing_id;
    public $billing_type;
    public $type;
    public $nominal = [];
    public $amount;
    public $nama;
    public $datetime_expired;
    public $i = 0;
    public $billing_details = [0];

    protected $rules = [
        'datetime_expired' => 'required|date_format:"Y-m-d H:i:s"',
        'nama.0' => 'required',
        'nominal.0' => 'required|max:14',
        'nama.*' => 'required',
        'nominal.*' => 'required|max:14',
        'amount' => 'nullable'
    ];

    protected $messages = [
        'datetime_expired.required' => 'Tanggal kadaluarsa tidak boleh kosong',
        'datetime_expired.date_format' => 'Format tanggal tidak sesuai',
        'nama.0.required' => 'Nama keterangan harus diisi!',
        'nominal.0.required' => 'Nominal Tagihan harus diisi!',
        'nominal.0.max' => 'Nominal tagihan terlalu besar',
        'nama.*.required' => 'Nama keterangan harus diisi!',
        'nominal.*.required' => 'Nominal Tagihan harus diisi!',
        'nominal.*.max' => 'Nominal tagihan terlalu besar'
    ];

    public function mount(Billing $billing)
    {
        $this->billing_id = $billing->id;
        $this->billing_type = $billing->billing_type;
        $this->type = $billing->type;
        $this->amount = $billing->amount;
        $this->datetime_expired = $billing->datetime_expired;
        $this->i = $billing->billingDetails()->count() - 1;
        foreach ($billing->billingDetails as $key => $value) {
            $this->billing_details[$key] = $value;
            $this->nama[$key] = $value->nama;
            $this->nominal[$key] = $value->nominal;
        }
    }

    public function render()
    {
        $this->amount = array_sum($this->nominal);
        return view('livewire.dash.keuangan.billing-edit');
    }

    public function add($i)
    {
        $i += 1;
        $this->i = $i;
        array_push($this->billing_details, $i);
    }

    public function remove($key)
    {
        unset($this->billing_details[$key]);
        $this->nama[$key] = '';
        $this->nominal[$key] = '';
    }

    public function update(Billing $billing)
    {
        $validatedData = $this->validate();
        $billing->update($validatedData);
        $newBilling = $billing->billingDetails()->delete();

        foreach ($this->nama as $key => $value) {
            $billing->billingDetails()->create([
                'nama' => $this->nama[$key],
                'nominal' => $this->nominal[$key]
            ]);
        }

        $this->emit('openModal', 'alert-modal', [
            'emit' => 'closeBillingAlertModal',
            'title' => 'Billing Updated',
            'description' => 'Billing berhasil diupdate!'
        ]);
    }
}
