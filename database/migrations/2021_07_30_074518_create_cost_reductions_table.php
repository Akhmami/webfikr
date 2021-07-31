<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCostReductionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cost_reductions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->foreignId('biller_detail_id')->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->decimal('nominal', 14,0);
            $table->string('keterangan')->nullable();
            $table->enum('type', ['SPP', 'LAINNYA']);
            $table->enum('is_used', ['Y', 'N'])->default('N');
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
        Schema::dropIfExists('cost_reductions');
    }
}
