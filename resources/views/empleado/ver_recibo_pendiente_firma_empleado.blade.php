@extends('layouts.app')
@section('content')
{{-- Dentro de section va el contenido de la vista--}}
	@include('layouts.menu_empleado')
	<h3 align="center">VER RECIBO</h1>
	<p align="center"><strong>Usuario: </strong> {{ Auth::user()->name }}, esta conectado con el Rol de <strong>Empleado</strong></p>
<div align="center">
<iframe src='{{$id}}' width="1200" height="400" style="border: none;" ></iframe>
<br>
<a class="btn btn-primary" href="{{ url('/empleado/recibos_pendientes' ) }}" role="button">Volver</a>
<a class="btn btn-success" href="{{ url('/empleado/ver_recibo_firmado_empleado/'.$id_recibo) }}" role="button">Firmar</a>
</div>
@endsection
