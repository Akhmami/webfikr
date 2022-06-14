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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_detail_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->morphs('payment');
            $table->string('trx_id')->unique();
            $table->string('payment_ntb')->nullable();
            $table->string('customer_name')->nullable();
            $table->char('virtual_account', 16);
            $table->decimal('trx_amount', 14, 0)->default(0);
            $table->decimal('payment_amount', 14, 0)->default(0);
            $table->decimal('cumulative_payment_amount', 14, 0)->default(0);
            $table->enum('billing_type', ['o', 'i', 'c', 'b'])
                ->comment('open, partial, close, balance');
            $table->string('description')->nullable();
            $table->text('qty_spp')->nullable();
            $table->decimal('use_balance', 14, 0)->nullable();
            $table->timestamp('datetime_payment')->nullable();
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
        Schema::dropIfExists('payments');
    }
};
