<?php

namespace App\Http\Livewire\Dash\Psb;

use App\Libraries\VA;
use App\Models\Billing;
use Illuminate\Support\Facades\DB;
use LivewireUI\Modal\ModalComponent;

class EditVa extends ModalComponent
{
    public $billing;
    public $trx_amount;
    public $datetime_expired;

    protected $rules = [
        'trx_amount' => 'required|min:5',
        'datetime_expired' => 'required'
    ];

    public function mount(Billing $billing)
    {
        $this->billing = $billing;
        $this->trx_amount = $billing->trx_amount;
        $this->datetime_expired = $billing->datetime_expired;
    }

    public function render()
    {
        return view('livewire.dash.psb.edit-va');
    }

    public function update()
    {
        $validatedData = $this->validate();

        try {
            DB::beginTransaction();
            $this->billing->biller()->update([
                'amount' => $validatedData['trx_amount']
            ]);

            $this->billing->update($validatedData);

            $data = array(
                'trx_id' => $this->billing->trx_id,
                'trx_amount' => $validatedData['trx_amount'],
                'customer_name' => $this->billing->customer_name,
                'datetime_expired' => $validatedData['datetime_expired']
            );
            
            $va = new VA;
            $result = $va->update($data);
            if ($result['status'] !== '000') {
                $this->dispatchBrowserEvent('swal:modal', [
                    'type' => 'error',
                    'title' => 'Oops...!',
                    'text' => 'Gagal mengupdate VA. #status code: ' . $result['status']
                ]);
            } else {
                $this->emit('pendaftarDetail');

                $this->dispatchBrowserEvent('swal:modal', [
                    'type' => 'success',
                    'title' => 'VA Updated!',
                    'text' => 'VA berhasil di update '
                ]);
            }

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'error',
                'title' => 'Oops...!',
                'text' => 'Gagal mengupdate VA. #' . $th->getMessage()
            ]);
        }

        $this->closeModal();
    }
}
