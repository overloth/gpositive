<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeBodyOfArticles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //change body type to longtext
        Schema::table('articles', function (Blueprint $table) {
            $table->longtext('body')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //revert body back to string
        Schema::table('articles', function (Blueprint $table) {
            $table->string('body')->change();
        });
    }
}
