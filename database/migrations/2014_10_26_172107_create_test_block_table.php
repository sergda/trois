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
            $table->string('en_title', 255);
            $table->string('fr_title', 255);
            $table->string('en_description', 255);
            $table->string('fr_description', 255);
            $table->string('en_keywords', 255);
            $table->string('fr_keywords', 255);
            $table->string('slug', 255)->unique();
            $table->text('en_content');
            $table->text('fr_content');
            $table->string('en_image');
            $table->string('fr_image');
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
