<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagTestblockTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tag_testblock', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('testblock_id')->unsigned();
            $table->integer('tag_id')->unsigned();
        });

        Schema::table('tag_testblock', function (Blueprint $table) {
            $table->foreign('testblock_id')->references('id')->on('testblocks')
                        ->onDelete('cascade')
                        ->onUpdate('cascade');
        });

        Schema::table('tag_testblock', function (Blueprint $table) {
            $table->foreign('tag_id')->references('id')->on('tags')
                        ->onDelete('cascade')
                        ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tag_testblock', function (Blueprint $table) {
            $table->dropForeign('tag_testblock_post_id_foreign');
        });
        
        Schema::table('tag_testblock', function (Blueprint $table) {
            $table->dropForeign('tag_testblock_tag_id_foreign');
        });

        Schema::drop('tag_testblock');
    }
}
