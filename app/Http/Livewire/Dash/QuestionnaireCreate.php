<?php

namespace App\Http\Livewire\Dash;

use LivewireUI\Modal\ModalComponent;

class QuestionnaireCreate extends ModalComponent
{
    public $user;
    public $name;
    public $uri;
    public $role = 'user';
    public $status = 1;

    protected $rules = [
        'name' => 'required|min:3',
        'uri' => 'required|unique:questionnaires|min:3',
        'role' => 'nullable',
        'status' => 'nullable'
    ];

    public function mount()
    {
        $this->user = auth()->user();
    }

    public function render()
    {
        return view('livewire.dash.questionnaire-create');
    }

    public function store()
    {
        $validatedData = $this->validate();
        $this->user->questionnaires()->create($validatedData);
        $this->emit('questionnaireTable');
        $this->closeModal();

        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',
            'title' => 'Questionnaire Created!',
            'text' => 'Questionnaire berhasil dibuat, tambahkan pertanyaan, klik tombol +'
        ]);
    }
}
