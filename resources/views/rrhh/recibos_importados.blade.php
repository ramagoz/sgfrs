@extends('layouts.app')
@section('content')
{{-- Dentro de section va el contenido de la vista--}}
	@include('layouts.menu_rrhh')
	<h3 align="center">RECIBO IMPORTADOS</h1>
	<p align="center"><strong>Usuario: </strong> {{ Auth::user()->name }}, esta conectado con el Rol de <strong>Recursos Humanos</strong></p>

<div class="row">

    @foreach( $recibos as  $recibo )
    <div class="col-xs-6 col-sm-4 col-md-3 text-center">

            <h4 style="min-height:45px;margin:5px 0 10px 0">
                {{$recibo}}
                <br>
            </h4>
    </div>
    @endforeach

</div>

@endsection