<?php

namespace App\Http\Livewire\Dash;

use LivewireUI\Modal\ModalComponent;

class EditValue extends ModalComponent
{
    public $data;
    public $column;
    public $value;
    public $type;

    public function mount($model, $id, $column, $type = null)
    {
        $this->data = app('\\App\\Models\\' . $model)->find($id);
        $this->column = $column;
        $this->value = $this->data->$column;
        $this->type = $type;
    }

    public function render()
    {
        return view('livewire.dash.edit-value');
    }

    public function update()
    {
        $this->validate(['value' => 'required']);

        try {
            $this->data->update([$this->column => $this->value]);

            if ($this->data->wasChanged('status_psb_id')) {
                $status = null;
                if ($this->data->status_psb_id == 3) {
                    $status = 'santri';
                }

                $this->data->update(['status' => $status]);
            }

            $this->emit('openModal', 'alert-modal', [
                'status' => 'success',
                'emit' => 'closeAlertValue',
                'title' => $this->column . ' Terupdate!',
                'description' => 'Data ' . $this->column . ' berhasil diupdate.'
            ]);
        } catch (\Throwable $th) {
            $this->emit('openModal', 'alert-modal', [
                'status' => 'error',
                'emit' => 'closeAlertValue',
                'title' => 'Update Gagal',
                'description' => $th->getMessage()
            ]);
        }
    }
}
