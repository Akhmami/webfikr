<?php

namespace App\Http\Livewire\Dash\Keuangan;

use App\Models\Biller;
use App\Models\CostReduction;
use LivewireUI\Modal\ModalComponent;

class CostReductionEdit extends ModalComponent
{
    public $reduction;
    public $nominal;
    public $keterangan;

    public function mount(CostReduction $reduction)
    {
        $this->reduction = $reduction;
        $this->nominal = $reduction->nominal;
        $this->keterangan = $reduction->keterangan;
    }

    public function render()
    {
        return view('livewire.dash.keuangan.cost-reduction-edit');
    }

    public function update()
    {
        $validatedData = $this->validate([
            'nominal' => 'required',
            'keterangan' => 'required'
        ]);

        $this->reduction->billerDetail()->update(['keringanan' => $validatedData['nominal']]);
        $this->item->costReduction()->create($validatedData);


        $this->reduction->update($validatedData);

        $this->emit('openModal', 'alert-modal', [
            'status' => 'success',
            'emit' => 'closeCoseReductionAlertModal',
            'title' => 'Keringanan Biaya diupdate',
            'description' => 'Keringanan biaya berhasil diupdate!'
        ]);
    }
}
