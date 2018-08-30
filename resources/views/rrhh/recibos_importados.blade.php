@extends('layouts.app')
@section('content')
{{-- Dentro de section va el contenido de la vista--}}
	@include('layouts.menu_rrhh')
	<h3 align="center">RECIBOS IMPORTADOS</h1>
	<p align="center"><strong>Usuario: </strong> {{ Auth::user()->name }}, esta conectado con el Rol de <strong>Recursos Humanos</strong></p>

    <div align="center">
    <strong>Total de archivos procesados: </strong>{{$resultados[5] }}<br>
    <strong>Cantidad de recibos correctos procesados: </strong>{{$resultados[0] }}<br>
    <strong>Cantidad de recibos con error de periodo: </strong>{{$resultados[1] }}<br>
    <strong>Cantidad de recibos con error de extension: </strong>{{$resultados[2] }}<br>
    <strong>Cantidad de recibos con número de cedula no encontrado en el sistema: </strong>{{$resultados[3] }}<br> 
    <strong>Total de empleados del sistema sin recibos: </strong>{{$resultados[4] }}<br> 
    </div>

@endsection