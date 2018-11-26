@extends('layouts.app')
@section('content')
{{-- Dentro de section va el contenido de la vista--}}
	@include('layouts.menu_empresa')
	<h3 align="center">VER RECIBO FIRMADO EMPRESA</h1>
	<p align="center"><strong>Usuario: </strong> {{ Auth::user()->name }}, esta conectado con el Rol de <strong>Empresa</strong></p>

	@isset($msj)
		<div class="alert alert-success" role="alert" align="center">{{ $msj }}</div>
	@endisset
	
<div align="center">
<iframe src='{{$id}}' width="1200" height="400" style="border: none;" ></iframe>
<br>
<a class="btn btn-primary" href="{{ url('/empresa/recibos_pendientes_empleados' ) }}" role="button">Volver</a>
</div>
@endsection
