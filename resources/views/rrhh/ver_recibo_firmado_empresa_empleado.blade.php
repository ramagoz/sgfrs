@extends('layouts.app')
@section('content')
@include('layouts.menu_rrhh')

<div class="container">
  <p></p>
	<div class="page-header">
	    <h2>Ver Recibo Firmado por la Empresa y el Empleado</h2>
	</div>
	  <p></p>

	<iframe src='{{$id}}' width="100%" height="350" frameborder="0" type="application/pdf"></iframe>
	<br><br>

	<a class="btn btn-primary btn-lg" href="{{ url('/rrhh/firmados_empresa_empleados' ) }}" role="button">Volver</a>

</div>

@endsection