@extends('layouts.app')
@section('content')
{{-- Dentro de section va el contenido de la vista--}}
	@include('layouts.menu_rrhh')
<p align="center"><strong>Usuario: </strong> {{ Auth::user()->name }}, esta conectado con el Rol de <strong>Recursos Humanos</strong></p>
<h3 align="center">VER RECIBO A CORREGIR</h1>

<form action="/rhhh/corregir_recibo/" method="post">
	{{ csrf_field() }}

	<div align="center">
		<iframe src='{{$url}}' width="70%" height="350" style="border: none;" ></iframe>
		<br>
		<input type="hidden" name="id" id="id" required value="{{$id}}">
		<textarea rows="2" cols="100" placeholder="Ingrese el motivo por el cual va realizar la corección del recibo seleccionado"></textarea>
		<br>
		<a class="btn btn-primary" href="{{ url('/rrhh/lista_recibos' ) }}" role="button">Volver</a>
		<button type="sumibt" class="btn btn-success">Corregir</button>
	</div>
</form>
@endsection
