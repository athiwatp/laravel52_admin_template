<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGalleryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gallery', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('title',255);
            $table->text('description')->nullable();
            $table->char('tp',1);
            $table->string('filename',255)->nullable();
            $table->integer('user_id')->unsigned();
            $table->integer('chapter_id')->unsigned()->nullable();
            $table->smallInteger('pos');

            $table->timestamps();

            $table->foreign('user_id', 'gallery_users_foreign_key')
                    ->references('id')->on('users')
                    ->onDelete('cascade');

            $table->foreign('chapter_id', 'gallery_chapters_foreign_key')
                    ->references('id')->on('chapters')
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
        Schema::drop('gallery');
    }
}
