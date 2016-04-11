<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnToMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('static_menues', function (Blueprint $table) {
            if (Schema::hasColumn('static_menues', 'linked_to') === false ) {
                $table->integer('linked_to')->after('parent_id')->nullable()->unsigned();
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
        Schema::table('static_menues', function (Blueprint $table) {
            if ( Schema::hasColumn('static_menues', 'linked_to') ) {
                $table->dropColumn('linked_to');
            }
        });
    }
}
