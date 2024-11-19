<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveAuthorFromCommentsTable extends Migration
{
    public function up()
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->dropColumn('author'); // Drop the 'author' column
        });
    }

    public function down()
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->string('author'); // Add back the column if rolling back the migration
        });
    }
}
