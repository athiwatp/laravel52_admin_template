<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSessIdColumnToFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('files', function (Blueprint $table) {
            if (Schema::hasColumn('files', 'session_id') === false ) {
                $table->string('session_id', '255')->after('content_id')->nullable();
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
            if (Schema::hasColumn('files', 'session_id')) {
                $table->dropColumn('session_id');
            }
        });
    }
}
