<?php

namespace App\Http\Livewire\Dash;

use App\Models\Questionnaire;
use LivewireUI\Modal\ModalComponent;

class QuestionnaireAnswered extends ModalComponent
{
    public $user;
    public $questionnaire;
    public $qna;

    public function mount($user)
    {
        $this->user = $user;
        $this->questionnaire = Questionnaire::with('questions')
            ->where('tahun_psb', $user['tahun_pendaftaran'])
            ->first();

        foreach ($this->questionnaire->questions as $question) {
            $this->qna[] = [
                'question' => $question->question,
                'answer' => $question->answers()->answerApiFirst($user['id'])->first()->answer ?? null
            ];
        }
    }

    public function render()
    {
        return view('livewire.dash.questionnaire-answered');
    }
}
