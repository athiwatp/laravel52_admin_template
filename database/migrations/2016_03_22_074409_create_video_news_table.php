<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideoNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('video_news', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('title',255);
            $table->text('content');
            $table->date('date');
            $table->string('url',500);
            $table->char('is_published',1);
            $table->integer('user_id')->unsigned();

            $table->timestamps();

            $table->foreign('user_id', 'video_news_foreign_key')
                ->references('id')->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('video_news');
    }
}
