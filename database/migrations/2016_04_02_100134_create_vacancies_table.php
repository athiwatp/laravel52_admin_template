<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVacanciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vacancies', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('title',255);
            $table->date('date_reg');
            $table->date('valid_before');
            $table->integer('employer')->nullable();
            $table->string('type_employment',255);
            $table->text('requirements');
            $table->text('description');
            $table->string('phone',50);
            $table->string('contact_person',255);
            $table->string('email',255);
            $table->string('wage',255);
            $table->char('is_published',255);
            $table->integer('user_id')->unsigned();

            $table->timestamps();

            $table->foreign('user_id', 'vacancies_users_foreign_key')
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
        Schema::drop('vacancies');
    }
}
