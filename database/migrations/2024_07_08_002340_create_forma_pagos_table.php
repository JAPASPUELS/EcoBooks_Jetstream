<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormaPagosTable extends Migration
{
    public function up()
    {
        Schema::create('forma_pagos', function (Blueprint $table) {
            $table->string('fpa_id', 3)->primary();
            $table->string('fpa_nombre', 30);
        });
    }

    public function down()
    {
        Schema::dropIfExists('forma_pagos');
    }
}

