<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePsbYearsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('psb_years', function (Blueprint $table) {
            $table->id();
            $table->char('period', 4);
            $table->string('batch_of_smp', 4)->default(00);
            $table->string('batch_of_sma', 4)->default(00);
            $table->enum('is_active', ['Y', 'N']);
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
        Schema::dropIfExists('psb_years');
    }
}
