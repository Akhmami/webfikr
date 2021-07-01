<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDormitoryUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dormitory_user', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dormitory_id');
            $table->unsignedBigInteger('user_id');
            $table->char('tahun_ajaran', 4)->nullable();
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
        Schema::dropIfExists('dormitory_user');
    }
}
