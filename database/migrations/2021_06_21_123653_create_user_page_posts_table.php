<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserPagePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_page_posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->enum('visible', ['all', 'menunggu', 'terdaftar', 'diterima', 'tidak diterima', 'cadangan', 'mundur']);
            $table->enum('jenjang', ['all', 'SMP', 'SMA'])->nullable();
            $table->enum('type', ['all', 'internal', 'eksternal'])->nullable();
            $table->char('gelombang', 2)->nullable();
            $table->text('excerpt')->nullable();
            $table->text('body');
            $table->tinyInteger('pinned')->nullable();
            $table->timestamp('published_at')->nullable();
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
        Schema::dropIfExists('user_page_posts');
    }
}
