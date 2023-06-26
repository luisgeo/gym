<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->increments('id_producto');

            $table->string('nombre');

            $table->string('marca');

            $table->double('precio');

            $table->double('descuento');

            $table->integer('stock');

            $table->string('descripcion');

            $table->integer('id_proveedor')->unsigned();
            $table->foreign('id_proveedor')->references('id_proveedor')->on('proveedores');

            $table->integer('id_almacen')->unsigned();
            $table->foreign('id_almacen')->references('id_almacen')->on('almacenes');

            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productos');
    }
}
