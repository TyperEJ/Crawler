<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBotColumnToLineMembers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('line_members', function (Blueprint $table) {
            $table->text('channel_secret');
            $table->text('channel_token');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('line_members', function (Blueprint $table) {
            $table->dropColumn('channel_secret');
            $table->dropColumn('channel_token');
        });
    }
}
