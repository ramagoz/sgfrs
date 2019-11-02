<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SGFRS</title>
    <!-- Scripts -->
    <!--<script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('https://code.jquery.com/jquery-3.3.1.min.js') }}" defer></script>-->
    <!-- Fonts -->
   <!-- <script src="{{ asset('js/app.js') }}" defer></script>
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>
<body>

   <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    SGFRS
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                        <!--
                            <li><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li>
                            <li><a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a></li>
                          -->
                        @else
                            <li class="nav-item dropdown">    
                                  <strong> Usuario:</strong>  
                                  {{ Auth::user()->name }}
                                  <!--<strong>- Rol:</strong>  
                                  @if (Session::get('rol_usuario') ==1)
                                  Empleado
                                  @endif
                                   @if (Session::get('rol_usuario') ==2)
                                  RRHH
                                  @endif
                                   @if (Session::get('rol_usuario') ==3)
                                  Empresa
                                  @endif
                                   @if (Session::get('rol_usuario') ==4)
                                  Empresa
                                  @endif
                                   @if (Session::get('rol_usuario') ==5)
                                  Oficial de Seguridad
                                  @endif-->
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">

            @yield('content')

        </main>
    </div>


</body>
</html>
