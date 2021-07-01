<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSetPsbsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('set_psbs', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 25);
            $table->char('tahun_pendaftaran', 4);
            $table->decimal('biaya', 14,0)->default(0);
            $table->char('angkatan_smp', 2)->default('00');
            $table->char('angkatan_sma', 2)->default('00');
            $table->char('gelombang', 2);
            $table->timestamp('datetime_expired')->nullable();
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
        Schema::dropIfExists('set_psbs');
    }
}
