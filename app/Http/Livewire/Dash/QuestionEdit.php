<?php

namespace App\Http\Livewire\Dash;

use App\Models\QuestionnaireQuestion;
use LivewireUI\Modal\ModalComponent;

class QuestionEdit extends ModalComponent
{
    public $question;
    public $questQuestion;

    protected $rules = [
        'question' => 'required|min:3|max:255'
    ];

    public function mount(QuestionnaireQuestion $question)
    {
        $this->questQuestion = $question;
        $this->question = $question->question;
    }

    public function render()
    {
        return view('livewire.dash.question-edit');
    }

    public function update()
    {
        $validatedData = $this->validate();
        $this->questQuestion->update($validatedData);

        $this->emit('questionList');
        $this->closeModal();

        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',
            'title' => 'Question Updated!',
            'text' => 'Pertanyaan berhasil diupdate'
        ]);
    }
}
