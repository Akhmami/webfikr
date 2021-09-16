<?php

namespace App\Http\Livewire\Dash\Keuangan;

use App\Models\CostReduction;
use LivewireUI\Modal\ModalComponent;

class CostReductionDelete extends ModalComponent
{
    public $reduction;

    public function mount(CostReduction $reduction)
    {
        $this->reduction = $reduction;
    }

    public function render()
    {
        return view('livewire.dash.keuangan.cost-reduction-delete');
    }

    public function delete()
    {
        $this->reduction->delete();

        $this->emit('openModal', 'alert-modal', [
            'status' => 'success',
            'emit' => 'closeCoseReductionAlertModal',
            'title' => 'Keringanan Biaya dihapus',
            'description' => 'Keringanan biaya berhasil dihapus!'
        ]);
    }
}
