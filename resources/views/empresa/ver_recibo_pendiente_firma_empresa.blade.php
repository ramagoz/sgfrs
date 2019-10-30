@extends('layouts.app')
@section('content')
{{-- Dentro de section va el contenido de la vista--}}
	@include('layouts.menu_empresa')
	<h3 align="center">VER RECIBO PENDIENTE FIRMA EMPRESA</h1>
	<p align="center"><strong>Usuario: </strong> {{ Auth::user()->name }}, esta conectado con el Rol de <strong>Empresa</strong></p>
	@isset($error)
			<div class="alert alert-warning" role="alert" align="center">{{ $error }}</div>
	@endisset
	<div align="center">
	<iframe src='{{$id}}' width="1200" height="400" style="border: none;" ></iframe>
	<form action="/empresa/firmar_recibo_empresa/" method="post">
		{{ csrf_field() }}
		<label>Ingrese su contraseña de firma: </label>
		<input type="password" name="contraseña" id="contraseña" required>
		<button class="btn btn-success" type="submit">Firmar</button>
		<a class="btn btn-primary" href="{{ url('/empresa/recibos_pendientes_empresa' ) }}" role="button">Volver</a>
		<input type="hidden" name="id" id="id" value={{ $id_recibo }} >
	</form>
	</div>
@endsection
