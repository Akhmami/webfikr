<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('billings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('trx_id');
            $table->char('virtual_account', 16);
            $table->decimal('amount', 14,0);
            $table->decimal('cumulative_payment_amount', 14,0)->default(0);
            $table->enum('billing_type', ['o', 'i', 'c']);
            $table->enum('type', ['SPP', 'DKT', 'PSB', 'DUPSB', 'MUTASI', 'DUMUTASI', 'LAINNYA']);
            $table->enum('status', ['paid', 'unpaid', 'draft'])->default('unpaid');
            $table->string('description')->nullable();
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
        Schema::dropIfExists('billings');
    }
}
