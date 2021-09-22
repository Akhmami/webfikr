<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterUsersAddAnyColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->after('medical_check_id', function ($table) {
                $table->enum('jalur_masuk', ['psb', 'mutasi'])->default('psb');
                $table->char('tahun_pendaftaran', 4)->nullable();
                $table->char('tahun_ajaran', 4)->nullable();
                $table->enum('status', ['santri', 'keluar'])->nullable();
            });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
}
