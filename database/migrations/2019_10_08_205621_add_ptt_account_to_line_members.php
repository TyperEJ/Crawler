<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPttAccountToLineMembers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('line_members', function (Blueprint $table) {
            $table->string('ptt_account')
                ->nullable()
                ->after('channel_token');
            $table->text('ptt_password')
                ->nullable()
                ->after('ptt_account');
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
            $table->dropColumn('ptt_account');
            $table->dropColumn('ptt_password');
        });
    }
}
