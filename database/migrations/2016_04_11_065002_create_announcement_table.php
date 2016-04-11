<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnnouncementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('announcement', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('title',255);
            $table->text('description');
            $table->char('important',1)->default(0);
            $table->dateTime('date_start');
            $table->dateTime('date_end');
            $table->integer('chapter_id')->nullable();
            $table->integer('user_id')->unsigned();
            $table->string('image',255)->nullable();
            $table->char('is_published',1);

            $table->timestamps();

            $table->foreign('user_id', 'announcement_users_foreign_key')
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
        Schema::drop('announcement');
    }
}
