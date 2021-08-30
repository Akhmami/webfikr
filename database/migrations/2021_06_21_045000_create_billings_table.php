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
            $table->foreignId('biller_id')->nullable()->constrained();
            $table->foreignId('user_id')->constrained();
            $table->string('trx_id')->unique();
            $table->string('customer_name')->nullable();
            $table->char('virtual_account', 16);
            $table->decimal('trx_amount', 14, 0);
            $table->enum('billing_type', ['o', 'i', 'c', 'saldo']);
            $table->enum('is_paid', ['Y', 'N'])->default('N');
            $table->string('description')->nullable();
            $table->text('spp_pay_month')->nullable();
            $table->timestamp('datetime_expired')->nullable();
            $table->enum('is_balance', ['Y', 'N'])->default('N');
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
