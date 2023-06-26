<?php

namespace App\Http\Controllers;

use App\Models\Queja;
use Illuminate\Http\Request;

class QuejaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $quejas = Queja::all();
        //return 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //return
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $datos = request()->except('_token');
        Queja::insert($datos);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Queja  $queja
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $queja = json_decode(Queja::where('id_queja', $id)->get()->toJson());
        // return 
    }

   
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Queja  $queja
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $datos = request()->except('_token', '_method');
        Queja::where('id_queja', $id)->update($datos);
        //return redirect
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Queja  $queja
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Queja::destroy($id);
        // redirect
    }
}
