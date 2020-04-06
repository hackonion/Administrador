<?php

namespace App\Http\Controllers;

use App\trabajador;
Use App\puestos;
Use App\sucursales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class AccesoController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     *
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function getPuestos(Request $request){

            $data =  puestos::all('clv_Puesto','nombre');
            return response()->json($data);
    }

    public function getSucursales(Request $request){
        $data = sucursales::all('clv_Sucursal','nombre');
        return response()->json($data);

    }

    public function getLast(Request $request){
        $data = trabajador::all('clv_trab')->last();
        
        return response()->json($data);
    }
    

    public function index(Request $request)
    {
        if($request->ajax()){
            //$data = trabajador::all( 'clv_trab','clvE_sucursal','clvE_puesto','nombre','paterno','materno','fec_ing');
            $data = DB::table('trabajador')
            ->select('clv_trab','clvE_sucursal','clvE_puesto','nombre','paterno','materno','fec_ing')
            ->orderBy('clv_trab')
            ->get();
            return response()->json($data);
        }else{
            return view('acceso'); 
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
        $trabajador = new trabajador();
        $trabajador->clv_trab = $request->clv_trab;
        $trabajador->clvE_sucursal = $request->clvE_sucursal;
        $trabajador->clvE_puesto = $request->clvE_puesto;
        $trabajador->nombre = strtoupper($request->nombre);
        $trabajador->paterno = strtoupper($request->paterno);
        $trabajador->materno = strtoupper($request->materno);
        $trabajador->save();

        return response()->json($trabajador);
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
        $trabajador = trabajador::find($id);
        $trabajador->clv_trab = $request->clv_trab;
        $trabajador->clvE_sucursal = $request->clvE_sucursal;
        $trabajador->clvE_puesto = $request->clvE_puesto;
        $trabajador->nombre = strtoupper($request->nombre);
        $trabajador->paterno = strtoupper($request->paterno);
        $trabajador->materno = strtoupper($request->materno);
        $trabajador->save();
        return $trabajador;
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
        $trabajador = trabajador::find($id);
        $trabajador->delete();
    
    }
}
