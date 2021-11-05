<?php

namespace App\Http\Livewire\Dash;

use App\Models\Questionnaire;
use App\Models\QuestionnaireQuestion;
use LivewireUI\Modal\ModalComponent;

class QuestionList extends ModalComponent
{
    public $questionnaire;

    protected $listeners = [
        'questionList' => '$refresh'
    ];

    public function mount(Questionnaire $questionnaire)
    {
        $this->questionnaire = $questionnaire->load('questions');
    }

    public function render()
    {

        return view('livewire.dash.question-list', [
            'questions' => $this->questionnaire->questions
        ]);
    }

    public function destroyConfirm($id)
    {
        $this->dispatchBrowserEvent('swal:confirm', [
            'type' => 'warning',
            'title' => 'Yakin ingin menghapus?',
            'text' => '',
            'id' => $id,
            'method' => 'destroy'
        ]);
    }

    public function destroy($id)
    {
        QuestionnaireQuestion::destroy($id);
        $this->emit('questionList');
        // $this->closeModal();

        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',
            'title' => 'Question Deleted!',
            'text' => 'Pertanyaan berhasil dihapus'
        ]);
    }
}
