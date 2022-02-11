<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchedulesForeignTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('schedules', function (Blueprint $table) {
            $table->foreign('id_time_from')->references('id')->on('from_go');
            $table->foreign('id_time_go')->references('id')->on('to_go');
            $table->foreign('id_operator')->references('id')->on('operators');
            $table->foreign('id_price')->references('id')->on('price_schedules');
            $table->foreign('id_diskon')->references('id')->on('discount_schedules');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('schedules', function (Blueprint $table) {
            //
        });
    }
}
