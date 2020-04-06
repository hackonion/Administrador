@extends('layouts.app')


@section('contenido')

<style type="text/css">
    .text-center{margin-top: 10px;};
</style>
@if (session()->has('flash'))
<div class="alert alert-info">{{session('flash')}}</div>
@endif
<div class="row">
    <div class="col-md-4 offset-4">
        <div class="card card-default">
            <div class="card-header">
            <h5 class="text-center">Acceso a la aplicacion</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{route('login')}}">
                    @csrf
                    <div class="form-group {{ $errors->has('name') ? 'alert alert-danger' : ''}}" >
                        <label for="name">Usuario</label>
                        <input class="form-control"
                         type="text" 
                         name="name" 
                         value="{{old('name')}}"
                         placeholder="Ingrese usuario">
                        {!! $errors->first('name', '<span class="help-block">:message</span>') !!}
                    </div>
                    <div class="form-group {{ $errors->has('password') ? 'alert alert-danger' : ''}}" >
                        <label for="name">Password</label>
                        <input class="form-control"
                         type="password" 
                         name="password" 
                         placeholder="Ingrese password">
                         {!! $errors->first('password', '<span class="help-block">:message</span>') !!}
                    </div>
                    <button class="btn btn-primary btn-block">Acceder</button>
                </form>
            </div>
        </div>
    </div>
</div>    
@endsection