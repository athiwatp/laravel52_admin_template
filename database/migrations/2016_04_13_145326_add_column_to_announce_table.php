<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnToAnnounceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('announcement', function (Blueprint $table) {
            if (Schema::hasColumn('announcement', 'is_topical') === false ) {
                $table->char('is_topical', 1)->after('important')->default('0');
                $table->dateTime('top_date_end', 1)->after('is_topical')->nullable();

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
        Schema::table('announcement', function (Blueprint $table) {
            if (Schema::hasColumn('announcement', 'is_topical')) {
                $table->dropColumn('is_topical');
            }

            if (Schema::hasColumn('announcement', 'top_date_end')) {
                $table->dropColumn('top_date_end');
            }
        });
    }
}
