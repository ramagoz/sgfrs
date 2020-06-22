@extends('layouts.app')
@section('content')
@include('layouts.menu_empresa')

	<div class="container">
<p></p>
		<div class="page-header">
		    <h2>Ver recibo firmado por la empresa y el empleado</h2>
		</div>

<p></p>
		<iframe src='{{$id}}' width="100%" height="350" frameborder="0" allowfullscreen>
		</iframe><br><br>

		<a class="btn btn-primary" href="{{ url('/empresa/recibos_firmados_empresa_empleados' ) }}" role="button">Volver</a>

	</div>

@endsection