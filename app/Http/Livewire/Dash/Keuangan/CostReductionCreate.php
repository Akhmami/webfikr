<?php

namespace App\Http\Livewire\Dash\Keuangan;

use LivewireUI\Modal\ModalComponent;
use App\Models\BillerDetail;

class CostReductionCreate extends ModalComponent
{
    public $name;
    public $item;
    public $type;
    public $nominal;
    public $keterangan;
    public $user_id;

    protected $rules = [
        'nominal' => 'required',
        'keterangan' => 'required'
    ];

    protected $messages = [
        'nominal.required' => 'Nominal harus diisi!',
        'keterangan.required' => 'Keterangan harus diisi!'
    ];

    public function mount($item_id, $user_id)
    {
        $this->item = BillerDetail::with('biller')->findOrfail($item_id);
        $this->name = $this->item->biller->user->name;
        $this->type = $this->item->biller->type !== 'SPP' ? 'LAINNYA' : 'SPP';
        $this->user_id = $user_id;
    }

    public function render()
    {
        return view('livewire.dash.keuangan.cost-reduction-create');
    }

    public function create()
    {
        $validatedData = $this->validate();
        $validatedData['user_id'] = $this->user_id;
        $validatedData['type'] = $this->type;
        $cost = $this->item->biller->cost_reduction + $validatedData['nominal'];

        $this->item->update(['keringanan' => $validatedData['nominal']]);
        $this->item->costReduction()->create($validatedData);
        // $this->item->biller()->update([
        //     'cost_reduction' => $cost
        // ]);

        $this->emit('openModal', 'alert-modal', [
            'status' => 'success',
            'emit' => 'closeCoseReductionAlertModal',
            'title' => 'Keringanan Biaya Tersimpan',
            'description' => 'Keringanan biaya berhasil dibuat!'
        ]);
    }
}
