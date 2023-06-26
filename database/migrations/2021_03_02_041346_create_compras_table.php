<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateComprasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compras', function (Blueprint $table) {
            $table->increments('id_compra');

            $table->integer('id_caja');
            $table->foreign('id_caja')->references('id')->on('users');

            $table->integer('id_cliente');
            $table->foreign('id_cliente')->references('id_cliente')->on('catclientes')->nullable();

            $table->timestamp('fecha_compra')->default(DB::raw('CURRENT_TIMESTAMP'));

            $table->integer('estatus');

            $table->double('total');

            $table->enum('tipo_compra', [1, 2, 3, 4]); //1 => unitario; 2 => medio mayoreo; 3 => mayoreo; 4 => super mayoreo;

            $table->double('recibido')->nullable();

            $table->double('cambio')->nullable();

            $table->double('acumulado_cliente');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('compras');
    }
}
