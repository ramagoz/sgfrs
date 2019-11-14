<!DOCTYPE html>
<html>

<head>
    <title>SGFRS</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('otros/datatable/jquery.min.js') }}" ></script>
</head>

<body>
  <div id="app" class="d-flex flex-column h-screen">
    <header>

    </header>

    <main class="text-center py-2">

      @yield('content')

      <div class="fixed-bottom">
        <footer class="bg-white text-center text-black-50 shadow">
          <div class="row" >
            <div class="col">
              <span class="justify-content-center">
                @switch(Session::get('rol_usuario'))
                  @case(1)
                    <strong>Usuario: </strong> {{ Auth::user()->name }} <strong> - Rol: </strong> Empleado
                  @break
                  @case(2)
                    <strong>Usuario: </strong> {{ Auth::user()->name }} <strong> - Rol: </strong>Empleado/RRHH
                  @break
                  @case(3)
                    <strong>Usuario: </strong> {{ Auth::user()->name }}<strong> - Rol: </strong>Empresa
                  @break
                  @case(4)
                    <strong>Usuario: </strong> {{ Auth::user()->name }}<strong> - Rol: </strong>Empresa/Empleado
                  @break
                  @case(5)
                    <strong>Usuario: </strong> {{ Auth::user()->name }}<strong> - Rol: </strong>Oficial de Seguridad/Empleado
                  @break
                @endswitch

              </span>
            </div>
            <div class="col">
              <span class="justify-content-center">
                {{config('app.name')}} | Copyright @ {{date('Y')}}
              </span>
            </div>
            <div class="col">
              <span class="justify-content-center">
                <strong>Fecha y hora del Sistema: </strong>{{ date('d-m-Y H:m')}}
              </span>
            </div>
          </div>
        </footer>
      </div>

    </main>
  </div>
</body>
</html>