<?php

namespace App\Http\Livewire\Dash;

use App\Models\Questionnaire;
use LivewireUI\Modal\ModalComponent;

class QuestionCreate extends ModalComponent
{
    public $questionnaire;
    public $question;
    public $questionnaire_question_type_id = 3;

    protected $rules = [
        'question' => 'required|min:10|max:255',
        'questionnaire_question_type_id' => 'nullable'
    ];

    public function mount(Questionnaire $questionnaire)
    {
        $this->questionnaire = $questionnaire->load('questions');
    }

    public function render()
    {
        return view('livewire.dash.question-create');
    }

    public function store()
    {
        $validatedData = $this->validate();
        $this->questionnaire->questions()->create($validatedData);

        $this->emit('questionnaireTable');
        $this->closeModal();

        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',
            'title' => 'Question Created!',
            'text' => 'Pertanyaan berhasil ditambahkan'
        ]);
    }
}
