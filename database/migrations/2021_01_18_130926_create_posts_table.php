<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_sentence')->nullable();
            $table->text('description')->nullable();
            $table->text('contents')->nullable();
            $table->string('slug')->unique();
            $table->string('default_template')->default('blue');
            $table->integer('custom_template')->unsigned()->nullable();
            $table->foreign('custom_template')
                ->references('id')->on('templates')->onDelete('set null');
            $table->boolean('is_published')->default(true)->nullable();
            $table->string('css')->nullable();
            $table->string('js')->nullable();
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
        Schema::dropIfExists('posts');
    }
}
