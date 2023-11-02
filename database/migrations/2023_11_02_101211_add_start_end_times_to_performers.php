<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStartEndTimesToPerformers extends Migration
{
    public function up()
    {
        Schema::table('performers', function (Blueprint $table) {
            $table->time('start_time')->nullable()->default(null);
            $table->time('end_time')->nullable()->default(null);
        });
    }

    public function down()
    {
        Schema::table('performers', function (Blueprint $table) {
            $table->dropColumn('start_time');
            $table->dropColumn('end_time');
        });
    }
};
