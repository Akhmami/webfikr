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
            $table->enum('jurusan_pilihan', ['IPA', 'IPS', 'IPC']);
            $table->enum('jurusan', ['IPA', 'IPS', 'IPC'])->nullable();
            $table->enum('jenis_pendaftaran', ['internal', 'eksternal', 'beasiswa', 'anak karyawan']);
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
            $table->string('nama_ayah')->nullable();
            $table->char('tahun_lahir_ayah', 4)->nullable();
            $table->enum('pendidikan_ayah', ['SD', 'SMP', 'SMA', 'D3', 'S1', 'S2', 'S3'])->nullable();
            $table->string('pekerjaan_ayah')->nullable();
            $table->decimal('penghasilan_ayah', 14,0)->nullable();
            $table->string('tempat_kerja_ayah', 50)->nullable();
            $table->string('pendidikan_agama_ayah')->nullable();
            $table->string('baca_quran_ayah', 25)->nullable();
            $table->string('haji_umroh_ayah', 25)->nullable();
            $table->string('organisasi_islam_ayah')->nullable();
            $table->string('buku_bacaan_islam_ayah')->nullable();
            $table->string('nama_ibu')->nullable();
            $table->char('tahun_lahir_ibu', 4)->nullable();
            $table->enum('pendidikan_ibu', ['SD', 'SMP', 'SMA', 'D3', 'S1', 'S2', 'S3'])->nullable();
            $table->string('pekerjaan_ibu')->nullable();
            $table->decimal('penghasilan_ibu', 14,0)->nullable();
            $table->string('tempat_kerja_ibu', 50)->nullable();
            $table->string('pendidikan_agama_ibu')->nullable();
            $table->string('baca_quran_ibu', 25)->nullable();
            $table->string('haji_umroh_ibu', 25)->nullable();
            $table->string('organisasi_islam_ibu')->nullable();
            $table->string('buku_bacaan_islam_ibu')->nullable();
            $table->enum('jalur_masuk', ['psb', 'mutasi']);
            $table->char('gelombang', 2)->nullable();
            $table->char('tahun_pendaftaran', 4)->nullable();
            $table->char('tahun_ajaran', 4)->nullable();
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
