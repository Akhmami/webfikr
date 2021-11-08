<?php

namespace App\Http\Controllers;

use App\Models\Questionnaire;
use App\Models\QuestionnaireAnswer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SurveyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($uri)
    {
        $questionnaire = Questionnaire::with('questions')->where('uri', $uri)->first();

        return view('survey.index', [
            'questionnaire' => $questionnaire
        ]);
    }

    public function store(Request $request, $id)
    {
        $request->validate([
            'answer.*' => 'required|max:250'
        ], [
            'answer.*.required' => 'Jawaban harus diisi!',
            'answer.*.max' => 'Maksimal 250 karakter'
        ]);

        DB::beginTransaction();
        try {
            foreach ($request->answers as $question => $answer) {
                QuestionnaireAnswer::create([
                    'user_id' => auth()->id(),
                    'questionnaire_question_id' => $question,
                    'answer' => $answer
                ]);
            }

            DB::commit();

            return back()->with('success', 'Questionnaire telah terisi, terima kasih atas waktunya.');
        } catch (\Throwable $th) {
            DB::rollback();
            echo $th->getMessage();
            exit;
        }
    }
}