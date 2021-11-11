<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionnaireAnswer extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'questionnaire_question_id', 'answer'
    ];

    public function scopeAnswerApiFirst($query, $value)
    {
        return $query->where('user_id', $value);
    }
}
