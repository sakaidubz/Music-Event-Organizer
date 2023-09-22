<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->renameColumn('date', 'start_date');
            $table->renameColumn('venue_name', 'venue');
        });
    }
    
    public function down()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->renameColumn('start_date', 'date'); 
            $table->renameColumn('venue', 'venue_name'); 
        });
    }

};
