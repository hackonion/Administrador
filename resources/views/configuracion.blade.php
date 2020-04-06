@extends('layouts.nav')
<title>Configuración</title>

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

div input {
  text-transform: uppercase
}
</style>

@section('nav-bar')
    
@endsection

@section('contenedor')
<div id="app">
    <div class="container-xl">
        <configuracion></configuracion>
    </div>
</div>
@endsection
