<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
//    public function up()
//    {
//        Schema::create('templates', function (Blueprint $table) {
//            $table->increments('id');
//            $table->string('name');
//            $table->string('description')->nullable();
//            $table->string('file');
//            $table->string('css')->nullable();
//            $table->string('js')->nullable();
//
//            $table->integer('page_id')->unsigned()->nullable();
//            $table->foreign('page_id')
//                ->references('id')->on('pages');
//        });
//    }
//
//    /**
//     * Reverse the migrations.
//     *
//     * @return void
//     */
//    public function down()
//    {
//        Schema::dropIfExists('templates');
//    }
}
