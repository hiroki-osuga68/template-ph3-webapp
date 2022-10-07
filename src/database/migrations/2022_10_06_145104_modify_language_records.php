<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyLanguageRecords extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('language_records', function (Blueprint $table) {
            //
            $table->renameColumn('learning_content_id', 'learning_language_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('language_records', function (Blueprint $table) {
            //
            $table->renameColumn('learning_content_id', 'learning_language_id');
        });
    }
}
