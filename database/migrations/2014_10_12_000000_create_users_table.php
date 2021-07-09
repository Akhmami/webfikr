<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('gender', ['L', 'P']);
            $table->string('birth_place')->nullable();
            $table->date('birth_date')->nullable();
            $table->foreignId('status_psb_id')->nullable()->constrained();
            $table->foreignId('lokasi_test_id')->nullable()->constrained();
            $table->foreignId('test_date_id')->nullable()->constrained();
            $table->foreignId('medical_check_id')->nullable()->constrained();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });

        DB::statement(
            'ALTER TABLE users ADD FULLTEXT fulltext_index(name, username, email)'
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
