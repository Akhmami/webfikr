<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->string('nama')->nullable();
            $table->date('tanggal_lahir', 4)->nullable();
            $table->enum('pendidikan', ['SD', 'SMP', 'SMA', 'D3', 'S1', 'S2', 'S3'])->nullable();
            $table->string('pekerjaan')->nullable();
            $table->decimal('penghasilan', 14, 0)->nullable();
            $table->string('tempat_kerja', 50)->nullable();
            $table->string('pendidikan_agama')->nullable();
            $table->string('baca_quran', 25)->nullable();
            $table->string('haji_umroh', 25)->nullable();
            $table->string('organisasi_islam')->nullable();
            $table->string('buku_bacaan_islam')->nullable();
            $table->string('phone_number', 15)->nullable();
            $table->enum('is_first_number', ['Y', 'N'])->default('N');
            $table->enum('type', ['ayah', 'ibu']);
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
        Schema::dropIfExists('parents');
    }
};
