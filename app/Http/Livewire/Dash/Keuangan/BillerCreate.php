<?php

namespace App\Http\Livewire\Dash\Keuangan;

use LivewireUI\Modal\ModalComponent;
use App\Models\User;

class BillerCreate extends ModalComponent
{
    public $user_id;
    public $type;
    public $nominal = [];
    public $amount = 0;
    public $nama;
    public $i = 1;
    public $biller_details = [];
    public $is_installment;
    public $qty_spp;

    protected $rules = [
        'type' => 'required',
        'nama.0' => 'required',
        'nominal.0' => 'required|max:14',
        'nama.*' => 'required',
        'nominal.*' => 'required|max:14',
        'amount' => 'nullable',
        'is_installment' => 'required',
        'qty_spp' => 'nullable'
    ];

    protected $messages = [
        'type.required' => 'Item harus dipilih!',
        'nama.0.required' => 'Nama keterangan harus diisi!',
        'nominal.0.required' => 'Nominal Tagihan harus diisi!',
        'nominal.0.max' => 'Nominal tagihan terlalu besar',
        'nama.*.required' => 'Nama keterangan harus diisi!',
        'nominal.*.required' => 'Nominal Tagihan harus diisi!',
        'nominal.*.max' => 'Nominal tagihan terlalu besar',
        'is_installment.required' => 'Angsuran harus dipilih'
    ];

    public function mount($user_id)
    {
        $this->user_id = $user_id;
    }

    public function render()
    {
        $this->amount = array_sum($this->nominal);
        return view('livewire.dash.keuangan.biller-create');
    }

    public function add($i)
    {
        $i = $i + 1;
        $this->i = $i;
        array_push($this->biller_details, $i);
    }

    public function remove($key)
    {
        unset($this->biller_details[$key]);
    }

    public function create(User $user)
    {
        $validatedData = $this->validate();
        $billing = $user->billers()->create($validatedData);

        foreach ($this->nama as $key => $value) {
            $billing->billerDetails()->create([
                'nama' => $this->nama[$key],
                'nominal' => $this->nominal[$key]
            ]);
        }

        $this->emit('openModal', 'alert-modal', [
            'status' => 'success',
            'emit' => 'closeBillerAlertModal',
            'title' => 'Tagihan Tersimpan',
            'description' => 'Tagihan baru berhasil dibuat!'
        ]);
    }
}
