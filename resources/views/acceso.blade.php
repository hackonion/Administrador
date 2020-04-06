@extends('layouts.nav')
<title>Acceso</title>
<style type="text/css">
    .container-xl {
        margin-top:2%;
    }

    table{
        margin-top: 2%;
    }
    #agregar{
        margin-bottom: 1%;
    }
    div input {
  text-transform: uppercase
}

   /* .tableFixHead          { overflow-y:initial; height: 500px; }
.tableFixHead thead th { position: sticky; top: 0; }*/

tbody {
    display:block;
    height:400px;
    overflow:auto;
}
thead, tbody tr {
    display:table;
    width:100%;
    table-layout:fixed;
}

    
</style>

@section('nav-bar')
    
@endsection

@section('contenedor')
<div id="app">
    <div class="container-xl">
        <tarea></tarea>
    </div>
</div>

@endsection