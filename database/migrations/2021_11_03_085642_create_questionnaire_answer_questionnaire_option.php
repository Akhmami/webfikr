<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionnaireAnswerQuestionnaireOption extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questionnaire_answer_option', function (Blueprint $table) {
            $table->foreignId('questionnaire_answer_id')->constrained()->onDelete('cascade');
            $table->foreignId('questionnaire_option_id')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('questionnaire_answer_questionnaire_option');
    }
}
