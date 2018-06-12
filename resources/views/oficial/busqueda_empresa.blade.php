@extends('layouts.app')
@section('content')
{{-- Dentro de section va el contenido de la vista--}}
	@include('layouts.menu_oficial')
	<h3 align="center">BUSQUEDA DE DATOS DE EMPRESA</h1>
	<p align="center"><strong>Usuario: </strong> {{ Auth::user()->name }}, esta conectado con el Rol de <strong>Oficial de Seguridad</strong></p>


@endsection