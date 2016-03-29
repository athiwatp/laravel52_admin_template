<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUrlHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('url_history', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->date('add_date')->nullable();
            $table->integer('type_id');
            $table->string('url',255);
            $table->string('type', 20);

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
        Schema::drop('url_history');
    }
}
