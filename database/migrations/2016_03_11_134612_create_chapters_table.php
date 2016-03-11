<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChaptersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chapters', function (Blueprint $table) {
            $table->string('title',255);
            $table->text('description');
            $table->integer('parent_id')->nullable();
            $table->string('path', 150)->nullable();
            $table->smallInteger('pos')->nullable();
            $table->char('is_active',1);
            $table->char('type_chapter',1)->default(0);
            $table->date('date')->nullable();
            $table->string('number',100)->nullable();
            $table->integer('user_id')->unsigned();
            $table->string('icon',100)->nullable();

            $table->timestamps();

            $table->foreign('user_id', 'news_chapters_users_foreign_key')
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
        Schema::drop('chapters');
    }
}
