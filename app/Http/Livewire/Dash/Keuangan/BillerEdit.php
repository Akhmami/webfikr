<?php

namespace App\Http\Livewire\Dash\Keuangan;

use LivewireUI\Modal\ModalComponent;
use App\Models\Biller;

class BillerEdit extends ModalComponent
{
    public $biller;
    public $type;
    public $nominal = [];
    public $amount = 0;
    public $nama;
    public $i = 0;
    public $biller_details = [0];
    public $is_installment;
    public $qty_spp;

    protected $rules = [
        'nama.0' => 'required',
        'nominal.0' => 'required|max:14',
        'nama.*' => 'required',
        'nominal.*' => 'required|max:14',
        'amount' => 'nullable',
        'is_installment' => 'required',
        'qty_spp' => 'nullable'
    ];

    protected $messages = [
        'nama.0.required' => 'Nama keterangan harus diisi!',
        'nominal.0.required' => 'Nominal Tagihan harus diisi!',
        'nominal.0.max' => 'Nominal tagihan terlalu besar',
        'nama.*.required' => 'Nama keterangan harus diisi!',
        'nominal.*.required' => 'Nominal Tagihan harus diisi!',
        'nominal.*.max' => 'Nominal tagihan terlalu besar',
        'is_installment.required' => 'Angsuran harus dipilih'
    ];

    public function mount(Biller $biller)
    {
        $this->biller = $biller;
        $this->type = $biller->type;
        $this->amount = $biller->amount;
        $this->is_installment = $biller->is_installment;
        $this->qty_spp = $biller->qty_spp;
        $this->i = $biller->billerDetails()->count() - 1;
        foreach ($biller->billerDetails as $key => $value) {
            $this->biller_details[$key] = $value;
            $this->nama[$key] = $value->nama;
            $this->nominal[$key] = $value->nominal;
        }
    }

    public function render()
    {
        $this->amount = array_sum($this->nominal);
        return view('livewire.dash.keuangan.biller-edit');
    }

    public function add($i)
    {
        $i += 1;
        $this->i = $i;
        array_push($this->biller_details, $i);
    }

    public function remove($key)
    {
        unset($this->biller_details[$key]);
        $this->nama[$key] = '';
        $this->nominal[$key] = '';
    }

    public function update()
    {
        $user = $this->biller->user;
        $detail_id = $this->biller->billerDetails()->pluck('id')->toArray();
        $check = $user->costReductions()
            ->whereIn('biller_detail_id', $detail_id)->count();

        if ($check > 0) {
            $this->emit('openModal', 'alert-modal', [
                'status' => 'error',
                'emit' => '',
                'title' => 'Forbidden',
                'description' => 'Tagihan tidak bisa diupdate, memiliki keringanan biaya.'
            ]);
        } else {
            $validatedData = $this->validate();
            $this->biller->update($validatedData);
            $newBiller = $this->biller->billerDetails()->delete();

            foreach ($this->nama as $key => $value) {
                $this->biller->billerDetails()->create([
                    'nama' => $this->nama[$key],
                    'nominal' => $this->nominal[$key]
                ]);
            }

            $this->emit('openModal', 'alert-modal', [
                'status' => 'success',
                'emit' => 'closeBillerAlertModal',
                'title' => 'Tagihan Terupdate',
                'description' => 'Tagihan berhasil diupdate!'
            ]);
        }
    }
}
