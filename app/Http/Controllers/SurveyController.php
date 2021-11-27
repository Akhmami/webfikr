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
            'answers.*' => 'required|max:1000'
        ], [
            'answers.*.required' => 'Jawaban harus diisi!',
            'answers.*.max' => 'Maksimal 1000 karakter'
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

            auth()->user()->update(['questionnaire_psb' => 1]);

            DB::commit();

            return back()->with('success', 'Questionnaire telah terisi, terima kasih atas waktunya.');
        } catch (\Throwable $th) {
            DB::rollback();
            echo $th->getMessage();
            exit;
        }
    }
}
