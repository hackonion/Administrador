<?php

namespace App\Http\Controllers;

use App\Catalogo;
use App\Equipos;
use App\trabajador;
use Illuminate\Http\Request;

class AsignacionController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getUsuarios(Request $request){
        $data =trabajador::all('clv_trab','nombre');
        return response()->json($data);
    }

    public function getEquipos(Request $request){
        $data =Equipos::all('id','serie');
        return response()->json($data);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if($request->ajax()){
            $data = Catalogo::all();
            
            return response()->json($data);
        }else{
            return view('asignacion');
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
        $equipo = new Catalogo();
        $equipo->usuario = $request->usuario;
        $equipo->pass = strtoupper($request->pass);
        $equipo->equipo =strtoupper($request->equipo);
        $equipo->dir_ip = $request->dir_ip;
        $equipo->programas = strtoupper($request->programas);
        $equipo->save();

        return response()->json($equipo);
        
        
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
        $equipo = Catalogo::find($id);
        $equipo->usuario = $request->usuario;
        $equipo->pass = strtoupper($request->pass);
        $equipo->equipo =strtoupper($request->equipo);
        $equipo->dir_ip = $request->dir_ip;
        $equipo->programas = strtoupper($request->programas);
        $equipo->save();
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
        $catalogo = Catalogo::find($id);
        $catalogo->delete();

    }
}
