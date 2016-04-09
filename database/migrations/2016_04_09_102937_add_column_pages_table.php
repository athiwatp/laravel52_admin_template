<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('static_pages', function (Blueprint $table) {
            if (Schema::hasColumn('static_pages', 'subtitle') === false ) {
                $table->string('subtitle', 255)->after('title')->nullable();
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
        Schema::table('static_pages', function (Blueprint $table) {
            if ( Schema::hasColumn('static_pages', 'subtitle') ) {
                $table->dropColumn('subtitle');
            }
        });
    }
}
