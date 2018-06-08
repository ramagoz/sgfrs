@extends('layouts.app')

@section('content')
<link href="{{ asset('css/estilo_menu.css') }}" rel="stylesheet">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">PAGINA PRINCIPAL RRHH</div>

                <div class="card-body">
                    Contenido Página Principal RRHH
                    <div id="nav-wrapper">
                    <nav class="nav-menu">
                          <ul class="clearfix">
                             <li><a href="/">Inicio</a></li>
                             <li><a href="/Colaboradores">Colaboradores</a>
                             <ul class="sub-menu">
                                <li><a href="/jordan">Michael Jordan</a></li>
                                <li><a href="/hawking">Stephen Hawking</a></li>
                             </ul>
                             </li>
                             <li><a href="#!">Contáctenos</a>
                             <ul class="sub-menu">
                                <li><a href="mailto:soportedeerrores@empresa.com">Reportar un error</a></li>
                                <li><a href="/soporte">Servicio de soporte</a></li>
                             </ul>
                             </li>
                          </ul>
                    </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
