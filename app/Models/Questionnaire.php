<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Console\Question\Question;

class Questionnaire extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'role', 'status', 'uri'
    ];

    public function questions()
    {
        return $this->hasMany(QuestionnaireQuestion::class);
    }
}
