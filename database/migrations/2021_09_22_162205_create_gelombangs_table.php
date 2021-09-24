<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGelombangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gelombangs', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->dateTime('tgl_tes');
            $table->dateTime('tgl_wawancara');
            $table->dateTime('tgl_pengumuman');
            $table->dateTime('batas_pembayaran');
            $table->decimal('biaya_pendaftaran', 14, 0)->default(0);
            $table->text('deskripsi')->nullable();
            $table->enum('is_active', ['Y', 'N', 'I'])->nullable();
            $table->dateTime('datetime_expired');
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
        Schema::dropIfExists('gelombangs');
    }
}
