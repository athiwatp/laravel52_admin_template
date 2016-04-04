<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_reviews', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->date('date');
            $table->string('title',255);
            $table->text('comment');
            $table->integer('user_id')->unsigned();
            $table->char('is_published',1);

            $table->timestamps();

            $table->foreign('user_id', 'customer_reviews_users_foreign_key')
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
        Schema::drop('customer_reviews');
    }
}
