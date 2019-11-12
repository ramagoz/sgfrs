@extends('layouts.app')
@include('layouts.menu_rrhh')
@section('content')
{{-- Dentro de section va el contenido de la vista--}}

	<h3 align="center">VER RECIBO</h1>
<div align="center">
<iframe src='{{$id}}' width="1200" height="400" style="border: none;" ></iframe>
<br>
<a class="btn btn-primary" href="{{ url('/rrhh/todos_los_recibos' ) }}" role="button">Volver</a>
</div>
@endsection
