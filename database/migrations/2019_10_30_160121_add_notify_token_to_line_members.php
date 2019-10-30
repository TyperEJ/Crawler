<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNotifyTokenToLineMembers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('line_members', function (Blueprint $table) {
            $table->text('notify_token')
                ->nullable()
                ->after('ptt_password');
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
            $table->dropColumn('notify_token');
        });
    }
}
