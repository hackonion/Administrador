@extends('layouts.nav')
<title>Dasboard</title>
<style type="text/css">
    .container-sm{
        margin-top: 5%;
    }
</style>
@section('nav-bar')
    
@endsection

@section('contenedor')
<div class="container-sm">
<div class="row">
    <div class="col-md-6 offset-3">
        <div class="card">
            <div class="card-header">
            <h5 class="text-center">Controles</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <a href="{{action('AccesoController@index')}}" class="btn stretched-link"> <h5 class="text-center">Acceso</h5>
                        <img src="{{ asset('images/acc.ico') }}" class="img-fluid" alt="Responsive image"></a>
                    </div>
                    <div class="col">
                        <a href="{{action('ConfiguracionController@index')}}" class="btn stretched-link"> 
                        <h5 class="text-center">Configuración</h5>
                        <img src="{{ asset('images/conf.ico') }}" class="img-fluid" alt="Responsive image"></a>
                    </div>
                    <div class="w-100"></div>
                    <div class="col">
                    <a href="{{action('AsignacionController@index')}}" class="btn stretched-link"> 
                        <h5 class="text-center">Asignación</h5>
                        <img src="{{ asset('images/asig.ico') }}"class="img-fluid" alt="Responsive image"></a>
                    </div>  
                    <div class="col">
                        <a href="{{action('EquipoController@index')}}" class="btn stretched-link"> 
                            <h5 class="text-center">Equipos</h5>
                            <img src="{{ asset('images/equipos.ico') }}"class="img-fluid" alt="Responsive image"></a>
                        </div>       
                </div>
            </div>
        </div>
    </div>
</div>    
</div>
@endsection

