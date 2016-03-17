<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('title',255);
            $table->integer('chapter_id')->nullable();
            $table->longText('content');
            $table->dateTime('date');
            $table->integer('user_id')->unsigned();
            $table->string('source',100);
            $table->string('photo',100)->nullable();
            $table->string('url',255)->nullable();
            $table->char('is_published',1);
            $table->char('is_main',1);
            $table->char('is_important',1);
            $table->char('type_news',1)->default(0);

            $table->timestamps();

            $table->foreign('user_id', 'news_users_foreign_key')
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
        Schema::drop('news');
    }
}
