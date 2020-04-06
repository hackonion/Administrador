<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
   
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style type="text/css">
        #boton {
            margin-top: 10%;
        }
        #link{
            text-decoration: none;
        }


        
    </style>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
</head>

<body>
   
        <nav class="navbar navbar-dark bg-dark">
            <a href="{{route('dasboard')}}" id="link"> <h3 class="text-white">Villa Group</h3></a>
            @yield('nav-bar')
       
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                <form method="POST" action="{{route('logout')}}">
                    @csrf
                    <button type="submit" id="boton" class="btn btn-primary ">Cerrar sesion</button>
                </form>
                </li>
            </ul>
        </nav>
        <div></div>
            @yield('contenedor')
        </div>
        
    <link rel="stylesheet" href="{{ asset('js/app.js') }}">
    <script src="{{asset('js/app.js')}}"></script>
</body>
</html>