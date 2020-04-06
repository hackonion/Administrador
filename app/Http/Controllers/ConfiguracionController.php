<?php

namespace App\Http\Controllers;

use App\puestos;
use Illuminate\Http\Request;

class ConfiguracionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(Request $request)
    {
        //
        if($request->ajax()){
            $data = puestos::all('ident_puestos','clv_Puesto','nombre');
            
            return response()->json($data);
        }else{
            return view('configuracion'); 
        } 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $puesto = new puestos();
        $puesto->clv_Puesto = strtoupper($request->clv_Puesto);
        $puesto->nombre = strtoupper($request->nombre);
        $puesto->save();
        
        return response()->json($puesto);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $puesto =puestos::find($id);
        $puesto->ident_puestos = $request->ident_puestos;
        $puesto->clv_Puesto = strtoupper($request->clv_Puesto);
        $puesto->nombre = strtoupper($request->nombre);
        $puesto->save();

        return $puesto;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $puesto = puestos::find($id);
        $puesto->delete();
        return $puesto;
    }
}
