<?php

namespace App\Http\Livewire\Survey;

use Livewire\Component;

class Questions extends Component
{
    public $questionnaire;
    public $answer = [];

    protected $rules = [
        'answer' => 'required|array',
        'answer.*' => 'required|min:3'
    ];

    public function mount($questionnaire)
    {
        $this->questionnaire = $questionnaire->load('questions');
    }

    public function render()
    {
        return view('livewire.survey.questions');
    }

    public function store()
    {
        $this->validate();
        dd($this->answer);
    }
}
