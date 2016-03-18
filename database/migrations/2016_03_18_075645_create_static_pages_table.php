<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStaticPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('static_pages', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('title',255);
            $table->string('url',255)->nullable();
            $table->text('meta_keywords');
            $table->text('meta_descriptions');
            $table->longText('content');
            $table->char('is_published',1);
            $table->integer('user_id')->unsigned();

            $table->timestamps();

            $table->foreign('user_id', 'static_pages_users_foreign_key')
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
        Schema::drop('static_pages');
    }
}
