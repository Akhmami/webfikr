<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignId('status_psb_id')->nullable()->constrained();
            $table->foreignId('test_location_id')->nullable()->constrained();
            $table->foreignId('medical_check_id')->nullable()->constrained();
            $table->foreignId('gelombang_id')->nullable()->constrained();
            $table->tinyInteger('questionnaire_psb')->nullable();
            $table->char('reg_number', 8);
            $table->string('nis', 12)->nullable();
            $table->string('nisn', 12)->nullable();
            $table->char('nik', 16)->nullable();
            $table->enum('gender', ['L', 'P']);
            $table->string('birth_place')->nullable();
            $table->date('birth_date')->nullable();
            $table->enum('level', ['SMP', 'SMA']);
            $table->char('angkatan', 2)->default('00');
            $table->enum('choice_major', ['IPA', 'IPS', 'IPC'])->nullable();
            $table->enum('major', ['IPA', 'IPS', 'IPC'])->nullable();
            $table->enum('reg_type', ['internal', 'eksternal', 'beasiswa', 'anak karyawan'])->nullable();
            $table->string('school_origin')->nullable();
            $table->char('npsn', 10)->nullable();
            $table->string('school_origin_addr')->nullable();
            $table->string('school_origin_phone', 15)->nullable();
            $table->string('country', 50)->nullable();
            $table->string('addr')->nullable();
            $table->string('province', 50)->nullable();
            $table->string('city', 50)->nullable();
            $table->string('kec', 50)->nullable();
            $table->string('kel', 50)->nullable();
            $table->enum('reg_from', ['psb', 'mutasi'])->default('psb');
            $table->enum('status', ['santri', 'keluar'])->nullable();
            $table->string('grade_mutation')->nullable();
            $table->string('reason_mutation')->nullable();
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
        Schema::dropIfExists('user_details');
    }
}
