<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImagesProjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images_project', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('element_id');
            $table->string('field', 50);
            $table->string('table', 50);
            $table->string('original_name', 255);
            $table->string('revent_name', 255);
            $table->string('description', 255);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('images_project');
    }
}
