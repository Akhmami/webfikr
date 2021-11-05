<?php

namespace App\Http\Livewire\Dash;

use App\Models\Questionnaire;
use LivewireUI\Modal\ModalComponent;

class QuestionCreate extends ModalComponent
{
    public $questionnaire;

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
    }
}
