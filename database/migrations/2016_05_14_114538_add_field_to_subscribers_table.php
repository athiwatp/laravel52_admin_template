<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldToSubscribersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('subscribers', function (Blueprint $table) {
            if (Schema::hasColumn('subscribers', 'activation_code') === false ) {
                $table->string('activation_code', 255)->after('is_active')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('subscribers', function (Blueprint $table) {
            if (Schema::hasColumn('subscribers', 'activation_code')) {
                $table->dropColumn('activation_code');
            }
        });
    }
}
