<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    
    <!-- Page Title -->
    <title>Airports USA</title>
    
    <meta name="keywords" content="#" />
    <meta name="description" content="Prueba de Back end" />
    <meta name="author" content="David De la Cruz" />
    
    <!-- Mobile Meta Tag -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fav and touch icons -->
    <link rel="shortcut icon" href="img/AirportIcon.png" />

    <!-- Google Web Font -->
    <link href='https://fonts.googleapis.com/css?family=Lato:400,300,700' rel='stylesheet' type='text/css'>
    
    <!-- Bootstrap CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet" />
    
    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <!-- Styles 
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    -->
    <!-- Modernizr -->
    <script src="js/modernizr-2.6.2.min.js"></script>
</head>
    <body>


        <div id="app">

            @yield('content')
        </div>

        <!-- BEGIN FOOTER -->
        <footer id="footer" class="bg-color2">
            <!-- BEGIN SOCIAL ICONS -->
            <ul class="sn-icons">
                <li><a href="https://mrdavidchz.github.io/resume/"><i class="icon-github"></i></a></li>
            </ul>
            <!-- END SOCIAL ICONS -->
            <p>Realizado por <a href="https://mrdavidchz.github.io/resume/" target="_blank">David De la Cruz</a></p>
        </footer>
        <!-- END FOOTER -->
        

        
    <!-- Libs -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

    <script src="https://maps.google.com/maps/api/js?key=AIzaSyC70orI4s96i17BF9aL2zeg0cFJ19zEJ3c&sensor=false" type="text/javascript"></script>
    <!-- replacement for select boxes -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>    
    


        <script src="js/bootstrap.min.js"></script>
        <script src="js/plugins.js" type="text/javascript"></script>
        <script src="js/richmarker.js" type="text/javascript"></script>
        <script src="js/scripts.js"></script>
        @yield('footer')
        
        
    </body>
</html>
