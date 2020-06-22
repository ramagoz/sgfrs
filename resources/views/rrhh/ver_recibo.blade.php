@extends('layouts.app')
@section('content')
@include('layouts.menu_rrhh')

<div class="container">
  <p></p>
	<div class="page-header">
	    <h2>Ver Recibo Pendiente de Firma Empresa</h2>
	</div>
	  <p></p>
<p align="center"><strong>Usuario: </strong> {{ Auth::user()->name }}, esta conectado con el Rol de <strong>Recursos Humanos</strong></p>
	<iframe src='{{$id}}' width="100%" height="350" frameborder="0" allowfullscreen>
	</iframe><br><br>
	<a class="btn btn-primary btn-lg" href="{{ url('/rrhh/pendientes_firma_empresa' ) }}" role="button">Volver</a>

</div>

@endsection