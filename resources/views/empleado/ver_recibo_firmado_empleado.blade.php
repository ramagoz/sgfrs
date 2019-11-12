@extends('layouts.app')
@include('layouts.menu_empleado')
@section('content')
{{-- Dentro de section va el contenido de la vista--}}
	<h3 align="center">VER RECIBO FIRMADO EMPLEADO</h1>

	@isset($msj)
		<div class="alert alert-success" role="alert" align="center">{{ $msj }}</div>
	@endisset

<div align="center">
<iframe src='{{$id}}' width="1200" height="400" style="border: none;" ></iframe>
<br>
<a class="btn btn-primary" href="{{ url('/empleado/recibos_pendientes' ) }}" role="button">Volver</a>
</div>
@endsection
