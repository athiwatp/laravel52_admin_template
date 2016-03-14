<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStaticMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('static_menus', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('title',255);
            $table->char('type_menu',1);
            $table->smallInteger('pos');
            $table->integer('parent_id')->nullable();
            $table->string('path', 500)->nullable();
            $table->smallInteger('children_count')->default(0);
            $table->char('is_published',1);
            $table->integer('page_id')->nullable();
            $table->char('is_loaded_by_default', 1)->dafault('0');
            $table->char('is_shown_print_version')->default('0');
            $table->char('is_redirectable')->default('0');
            $table->string('redirect_url', 150)->nullable();
            $table->integer('user_id')->unsigned();
            $table->string('url',255);

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
        Schema::drop('static_menus');
    }
}
