@extends('layouts.app')
@include('layouts.menu_rrhh')
@section('content')
<div class="container-fluid">

	<div class="page-header">
	    <h2>Ver recibo a corregir</h2>
	</div>

	<form action="/rrhh/lista_recibos/" method="post">
		{{ csrf_field() }}

		<div align="center">
			<iframe src='{{$url}}' width="100%" height="65%" frameborder="0" allowfullscreen>
			</iframe><br><br>

			<input type="hidden" name="id" id="id" required value="{{$id}}">
			<textarea rows="2" cols="100" name="motivo" id="motivo" placeholder="Ingrese el motivo por el cual va realizar la corección del recibo seleccionado" required=""></textarea>
			<br><br>
			<a class="btn btn-danger" href="{{ url('/rrhh/lista_recibos' ) }}" role="button">Cancelar</a>
			<button type="sumibt" class="btn btn-success">Corregir</button>
		</div>
	</form>
</div>
@endsection
