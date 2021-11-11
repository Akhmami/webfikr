<?php

namespace App\Http\Controllers\Api;

use App\Models\Questionnaire;
use App\Models\User;
use Illuminate\Http\Request;

class SurveyController extends BaseController
{
    public function index()
    {
        # code...
    }

    public function psb(Request $request)
    {
        $user = User::where('username', $request->username)->first();
        $questionnaire = Questionnaire::with('questions')
            ->where('tahun_psb', $user->tahun_pendaftaran)
            ->first();

        $qna = [];

        foreach ($questionnaire->questions as $question) {
            $qna[] = [
                'question' => $question->question,
                'answer' => $question->answers()->answerApiFirst($user->id)->first()->answer ?? null
            ];
        }

        return $qna;
    }
}
