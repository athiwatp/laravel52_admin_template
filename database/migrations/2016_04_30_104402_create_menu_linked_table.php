<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuLinkedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('static_linked_menu', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_menu')->unsigned();
            $table->integer('id_linked_menu')->unsigned();
            $table->timestamps();

            $table->foreign('id_menu', 'menulink_mainmenu_foreign_key')
                ->references('id')->on('static_menues')
                ->onDelete('cascade');

            $table->foreign('id_linked_menu', 'menulink_linkedmenu_foreign_key')
                ->references('id')->on('static_menues')
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
        Schema::drop('static_linked_menu');
    }
}
