<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pedidos = Pedido::all();
        return view('pedido.index', compact('pedidos'));
    }

    public function add($id){
        $id_usuario = session('id_usuario');
        $datos = [
            'id_usuario' => $id_usuario
        ];
        
        Pedido::insert($datos);
    }

    public function quit($id){

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function show($id_usuario)
    {
        $pedidos = json_decode(Pedido::where('id_usuario', $id_usuario)->get()->toJson());
        return view('pedido.show', compact('pedidos'));
    }

    
}
