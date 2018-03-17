<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorldTcTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('worldtcs', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('en_title', 255);
            $table->string('fr_title', 255);
            $table->string('de_title', 255);
            $table->string('en_description', 255);
            $table->string('fr_description', 255);
            $table->string('de_description', 255);
            $table->string('en_keywords', 255);
            $table->string('fr_keywords', 255);
            $table->string('de_keywords', 255);
            $table->string('slug', 255)->unique();
            $table->text('en_content');
            $table->text('fr_content');
            $table->text('de_content');
            $table->boolean('seen')->default(false);
            $table->boolean('active')->default(false);
            $table->boolean('is_menu')->default(false);
            $table->integer('user_id')->unsigned();
        });

        Schema::table('worldtcs', function (Blueprint $table) {
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
        Schema::table('worldtcs', function (Blueprint $table) {
            $table->dropForeign('worldtcs_user_id_foreign');
        });

        Schema::drop('worldtcs');
    }
}
