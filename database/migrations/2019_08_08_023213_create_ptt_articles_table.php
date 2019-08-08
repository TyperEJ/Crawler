<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePttArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ptt_articles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('board');
            $table->string('article_id');
            $table->string('title');
            $table->string('origin_url');
            $table->string('short_url')->nullable();
            $table->text('content')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ptt_articles');
    }
}
