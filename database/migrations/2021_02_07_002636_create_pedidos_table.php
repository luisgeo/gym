<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreatePedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historial_compra', function (Blueprint $table) {
            $table->increments('id_registro_compra');

            $table->integer('id_producto');
            $table->foreign('id_producto')->references('id_producto')->on('productos');

            $table->double('precio_aplicado');

            $table->integer('cantidad');

            $table->double('descuento_aplicado');

            $table->integer('id_almacen');
            $table->foreign('id_almacen')->references('id_almacen')->on('almacenes');

            $table->bigInteger('id_compra');
            $table->foreign('id_compra')->references('id_compra')->on('compras');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pedidos');
    }
}
