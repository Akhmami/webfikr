<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionnaireQuestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'question', 'questionnaire_question_type_id'
    ];

    public function answerFirst()
    {
        return $this->hasOne(QuestionnaireAnswer::class)->latest();
    }
}
