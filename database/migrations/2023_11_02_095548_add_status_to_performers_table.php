<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToPerformersTable extends Migration
{
    public function up()
    {
        Schema::table('performers', function (Blueprint $table) {
            DB::statement("ALTER TABLE performers 
                           ADD status ENUM('picked', 'booking', 'booked') 
                           NOT NULL DEFAULT 'picked'");
        });
    }

    public function down()
    {
        Schema::table('performers', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
