@extends('layouts.app')
@section('content')
{{-- Dentro de section va el contenido de la vista--}}
	@include('layouts.menu_rrhh')
	<h3 align="center">VER RECIBO</h1>
	<p align="center"><strong>Usuario: </strong> {{ Auth::user()->name }}, esta conectado con el Rol de <strong>Recursos Humanos</strong></p>
<div align="center">
<iframe src=<?php echo "/recibos/pendientes/2018/02/1111111-0218.pdf"?> width="1200" height="400" style="border: none;" ></iframe>
</div>
@endsection
