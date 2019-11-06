@extends('layouts.app')
@section('content')
{{-- Dentro de section va el contenido de la vista--}}
	@include('layouts.menu_rrhh')
	<h3 align="center">CORREGIR RECIBOS</h1>
	<p align="center"><strong>Usuario: </strong> {{ Auth::user()->name }}, esta conectado con el Rol de <strong>Recursos Humanos</strong></p>

	@isset($msj)
		<div class="alert alert-success" role="alert" align="center">{{ $msj }}</div>
	@endisset
	@isset($errormsj)
		<div class="alert alert-danger" role="alert" align="center">{{ $errormsj }}</div>
	@endisset

<hr>
<div align="center">
<form action="/rrhh/corregir_recibos" method="post">
{{ csrf_field() }}
	<label>Ingresar ID del Recibo a corregir: </label>
	<input type="text" name="id" id="id" size="15" minlength="11" maxlength="12" placeholder="Eje.: 1234567-0119" required>
	<br>
	<button type="sumibt" class="btn btn-primary">Corregir</button>
</form>
</div>

@endsection