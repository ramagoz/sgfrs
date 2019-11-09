@extends('layouts.app')
@section('content')
{{-- Dentro de section va el contenido de la vista--}}
	@include('layouts.menu_rrhh')
<p align="center"><strong>Usuario: </strong> {{ Auth::user()->name }}, esta conectado con el Rol de <strong>Recursos Humanos</strong></p>
<h3 align="center">Ver Recibo Corregido</h1>

<div align="center">
	<iframe src='{{$url}}' width="70%" height="350" style="border: none;" ></iframe>
	<br>
	<a class="btn btn-primary" href="{{ url('/rrhh/historial_recibos_corregidos' ) }}" role="button">Volver</a>
</div>

@endsection
