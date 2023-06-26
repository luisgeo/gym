<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuejasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quejas', function (Blueprint $table) {
            $table->increments('id_queja');

            $table->integer('id_compra');
            $table->foreign('id_compra')->references('id_compra')->on('compras');

            $table->integer('id_usuario');
            $table->foreign('id_usuario')->references('id_usuario')->on('usuarios');

            $table->integer('estatus');
            /* estatus = [
                '0' => Sin atender,
                '1' => Atendido,
                '2' => En proceso
            ] */

            $table->string('mensaje');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quejas');
    }
}
