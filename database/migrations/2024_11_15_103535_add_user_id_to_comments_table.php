<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdToCommentsTable extends Migration
{
    public function up()
    {
        Schema::table('comments', function (Blueprint $table) {
            // Add user_id as a foreign key referencing the users table
            $table->unsignedBigInteger('user_id'); // Add user_id column

            // Add the foreign key constraint
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('comments', function (Blueprint $table) {
            // Remove the foreign key and the column if we rollback the migration
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
}
