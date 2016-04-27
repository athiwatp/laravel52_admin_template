<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddParentIdColumnToFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('files', function (Blueprint $table) {
            if (Schema::hasColumn('files', 'parent_id') === false ) {
                $table->Integer('parent_id')->after('session_id')->unsigned()->nullable();
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
        Schema::table('files', function (Blueprint $table) {
            if (Schema::hasColumn('files', 'parent_id') === false ) {
                $table->dropColumn('parent_id');
            }
        });
    }
}
