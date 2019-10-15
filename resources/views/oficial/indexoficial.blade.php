@extends('layouts.app')
@section('content')
{{-- Dentro de section va el contenido de la vista--}}
	@include('layouts.menu_oficial')
	<h3 align="center">PÁGINA PRINCIPAL</h1>
	<p align="center"><strong>Bienvenido: </strong> {{ Auth::user()->name }}, esta conectado con el Rol de <strong>Oficial de Seguridad</strong></p>

<br>

<div align="center">
@foreach ($res as $r)
	{{ $r}}
@endforeach
</div>

@endsection
