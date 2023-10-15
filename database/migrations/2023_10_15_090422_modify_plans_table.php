<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyPlansTable extends Migration
{
    public function up()
    {
        Schema::table('plans', function (Blueprint $table) {
            $table->renameColumn('date', 'start_date');
            $table->string('title');
            $table->date('end_date');
        });
    }

    public function down()
    {
        Schema::table('plans', function (Blueprint $table) {
            $table->renameColumn('start_date', 'date');
            $table->dropColumn('title');
            $table->dropColumn('end_date');
        });
    }
};
