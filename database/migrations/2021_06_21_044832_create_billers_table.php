<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('billers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->decimal('amount', 14,0);
            $table->decimal('cumulative_payment_amount', 14,0)->default(0);
            $table->enum('type', ['SPP', 'DKT', 'PSB', 'DUPSB', 'MUTASI', 'DUMUTASI', 'LAINNYA']);
            $table->enum('is_installment', ['Y', 'N'])->default('N');
            $table->enum('is_active', ['Y', 'N'])->default('Y');
            $table->tinyInteger('qty_spp')->default(0);
            $table->date('previous_spp_date')->nullable();
            $table->string('description')->nullable();
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
        Schema::dropIfExists('billers');
    }
}
