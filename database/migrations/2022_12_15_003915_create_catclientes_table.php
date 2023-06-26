<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCatclientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catclientes', function (Blueprint $table) {
            $table->increments('id_cliente')->from(1000000);
            $table->string('nombre', 255);
            $table->bigInteger('telefono');
            $table->string('correo', 255)->nullable();
            $table->bigInteger('acumulado');
            $table->tinyInteger('estatus');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('catclientes');
    }
}
