<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsefulLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('useful_links', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('title',255);
            $table->string('url',255);
            $table->text('description');
            $table->integer('chapter_id')->nullable();
            $table->char('is_active',1);

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
        Schema::drop('useful_links');
    }
}
