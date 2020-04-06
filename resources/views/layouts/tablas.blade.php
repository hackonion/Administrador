<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <style type="text/css">
        .container {
            margin-top: 10%;
        }

        @media (min-width: 420px) {
            }
            .bd-placeholder-img-lg {
                font-size: 3.2rem;
            }
        }

        
    </style>
</head>
<body>
    <div class="container-md">
        
        @yield('cont')
    </div>
   
    <link rel="stylesheet" href="{{ asset('js/app.js') }}">
</body>
</html>