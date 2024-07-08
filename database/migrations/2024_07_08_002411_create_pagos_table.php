<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagosTable extends Migration
{
    public function up()
    {
        Schema::create('pagos', function (Blueprint $table) {
            $table->id('pag_id');
            $table->string('fpa_id', 3);
            $table->integer('vent_numero');
            $table->double('pag_valor');
            $table->date('pag_fecha');
            $table->foreign('fpa_id')->references('fpa_id')->on('forma_pagos');
        });
    }

    public function down()
    {
        Schema::dropIfExists('pagos');
    }
}
