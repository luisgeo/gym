<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*
        rol = [
            '1' => 'Cliente,
            '2' => 'Administrador',
            '3' => 'Repartidor'
        ]
        */

        Schema::create('usuarios', function (Blueprint $table) {
            $table->increments('id_usuario');

            $table->integer('cp');

            $table->string('telefono');

            $table->integer('rol');

            $table->boolean('membresia')->nullable();

            $table->integer('strikes')->nullable();
            
            $table->integer('id_user');
            $table->foreign('id_user')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuarios');
    }
}
