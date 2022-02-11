<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailTransportsForeignTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('detail_transports', function (Blueprint $table) {
            $table->foreign('id_public_transport')->references('id')->on('public_transports');
            $table->foreign('id_layout_transport')->references('id')->on('layout_transports');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('detail_transports', function (Blueprint $table) {
            //
        });
    }
}
