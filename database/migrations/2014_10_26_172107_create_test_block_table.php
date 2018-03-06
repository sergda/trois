<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTestBlockTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('testblocks', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('title', 255);
            $table->string('description', 255);
            $table->string('keywords', 255);
            $table->string('slug', 255)->unique();
            $table->text('summary');
            $table->text('content');
            $table->string('image');
            $table->boolean('seen')->default(false);
            $table->boolean('active')->default(false);
            $table->integer('user_id')->unsigned();
        });

        Schema::table('testblocks', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')
                        ->onDelete('restrict')
                        ->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('testblocks', function (Blueprint $table) {
            $table->dropForeign('testblocks_user_id_foreign');
        });

        Schema::drop('testblocks');
    }
}
