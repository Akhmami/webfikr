<?php

namespace App\Http\Livewire\Dash\Keuangan;

use LivewireUI\Modal\ModalComponent;
use App\Models\User;

class BillingCreate extends ModalComponent
{
    public $user_id;
    public $billing_type;
    public $type;
    public $nominal = [];
    public $amount = 0;
    public $nama;
    public $datetime_expired;
    public $i = 1;
    public $billing_details = [];

    protected $rules = [
        'type' => 'required',
        'billing_type' => 'required',
        'datetime_expired' => 'required|date_format:"Y-m-d H:i:s"',
        'nama.0' => 'required',
        'nominal.0' => 'required|max:14',
        'nama.*' => 'required',
        'nominal.*' => 'required|max:14',
        'amount' => 'nullable'
    ];

    protected $messages = [
        'type.required' => 'Item harus dipilih!',
        'billing_type.required' => 'Item harus dipilih!',
        'datetime_expired.required' => 'Tanggal kadaluarsa tidak boleh kosong',
        'datetime_expired.date_format' => 'Format tanggal tidak sesuai',
        'nama.0.required' => 'Nama keterangan harus diisi!',
        'nominal.0.required' => 'Nominal Tagihan harus diisi!',
        'nominal.0.max' => 'Nominal tagihan terlalu besar',
        'nama.*.required' => 'Nama keterangan harus diisi!',
        'nominal.*.required' => 'Nominal Tagihan harus diisi!',
        'nominal.*.max' => 'Nominal tagihan terlalu besar'
    ];

    public function mount($user_id)
    {
        $this->user_id = $user_id;
    }

    public function render()
    {
        $this->amount = array_sum($this->nominal);
        return view('livewire.dash.keuangan.billing-create');
    }

    public function add($i)
    {
        $i = $i + 1;
        $this->i = $i;
        array_push($this->billing_details, $i);
    }

    public function remove($key)
    {
        unset($this->billing_details[$key]);
    }

    public function create(User $user)
    {
        $validatedData = $this->validate();
        $validatedData['trx_id'] = substr($this->type, 0, 3) . $user->userDetail->jenjang . $user->userDetail->no_pendaftaran . 'T' . date('Ymdhis');
        $validatedData['virtual_account'] = '1234567890123456';
        $billing = $user->billings()->create($validatedData);

        foreach ($this->nama as $key => $value) {
            $billing->billingDetails()->create([
                'nama' => $this->nama[$key],
                'nominal' => $this->nominal[$key]
            ]);
        }

        $this->emit('openModal', 'alert-modal', [
            'emit' => 'closeBillingAlertModal',
            'title' => 'Billing Created',
            'description' => 'Billing baru berhasil dibuat!'
        ]);
    }
}
