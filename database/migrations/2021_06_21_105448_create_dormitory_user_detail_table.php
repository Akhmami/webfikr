<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDormitoryUserDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dormitory_user_detail', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dormitory_id');
            $table->unsignedBigInteger('user_detail_id');
            $table->char('school_year', 4)->nullable();
            $table->enum('is_active', ['Y', 'N']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dormitory_user_detail');
    }
}
