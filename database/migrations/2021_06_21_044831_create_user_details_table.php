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
            $table->foreignId('user_id')->constrained();
            $table->char('no_pendaftaran', 8);
            $table->string('nis', 12)->nullable();
            $table->string('nisn', 12)->nullable();
            $table->char('nik', 16)->nullable();
            $table->enum('jenjang', ['SMP', 'SMA']);
            $table->char('angkatan', 2)->default('00');
            $table->enum('jurusan_pilihan', ['IPA', 'IPS', 'IPC'])->nullable();
            $table->enum('jurusan', ['IPA', 'IPS', 'IPC'])->nullable();
            $table->enum('jenis_pendaftaran', ['internal', 'eksternal', 'beasiswa', 'anak karyawan'])->nullable();
            $table->string('asal_sekolah')->nullable();
            $table->char('npsn', 10)->nullable();
            $table->string('alamat_asal_sekolah')->nullable();
            $table->string('hp_asal_sekolah', 15)->nullable();
            $table->string('alasan_pindah')->nullable();
            $table->string('negara', 50)->nullable();
            $table->char('anak_ke', 2)->nullable();
            $table->char('jml_saudara', 2)->nullable();
            $table->string('alamat')->nullable();
            $table->string('provinsi', 50)->nullable();
            $table->string('kota', 50)->nullable();
            $table->string('kecamatan', 50)->nullable();
            $table->string('kelurahan', 50)->nullable();
            $table->string('mutasi_kelas')->nullable();
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
