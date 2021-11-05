<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionnaireQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questionnaire_questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('questionnaire_id')->constrained()->onDelete('cascade');
            $table->foreignId('questionnaire_question_type_id')->constrained()->onDelete('cascade');
            $table->string('question');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('questionnaire_questions');
    }
}
