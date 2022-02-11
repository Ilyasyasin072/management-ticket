<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailTransportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_transports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_public_transport');
            $table->string('tire_wheel');
            $table->string('colors');
            $table->string('plat_number');
            $table->unsignedBigInteger('id_layout_transport');
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
        Schema::dropIfExists('detail_transports');
    }
}
