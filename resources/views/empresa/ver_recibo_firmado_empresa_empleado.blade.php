@extends('layouts.app')
@include('layouts.menu_empresa')
@section('content')

	<div class="container">

		<div class="page-header">
		    <h2>Ver recibo firmado por la empresa y el empleado</h2>
		</div>

		<iframe src='{{$id}}' width="90%" height="65%" frameborder="0" allowfullscreen>
		</iframe><br>

		<a class="btn btn-primary" href="{{ url('/empresa/recibos_firmados_empresa_empleados' ) }}" role="button">Volver</a>

	</div>

@endsection