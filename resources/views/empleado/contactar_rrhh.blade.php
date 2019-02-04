@extends('layouts.app')
@section('content')
{{-- Dentro de section va el contenido de la vista--}}
	@include('layouts.menu_empleado')
	<h3 align="center">CONTACTAR CON RRHH</h1>
	<p align="center"><strong>Usuario: </strong> {{ Auth::user()->name }}, esta conectado con el Rol de <strong>Empleado</strong></p>
<div align="center">
<h2>En el caso de reclamo por algun incoveniente u <br>
error con los Recibos de Sueldos <br>
favor contactar con la Gerencia de RRHH <br>
Contacto: Juan Perez <br>
Tel.: 021 123 456 <br>
Correo: gerenciarrhh@empresa.com.py</h2>
</div>
@endsection