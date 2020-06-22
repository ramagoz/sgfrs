@extends('layouts.app')
@section('content')
@include('layouts.menu_rrhh')
<div class="container">
  <p></p>
	<div class="page-header">
	    <h2>Ver Recibo a Corregir</h2>
	</div>
	  <p></p>

	<form action="/rrhh/lista_recibos/" method="post">
		{{ csrf_field() }}

		<div >


<iframe src='{{$url}}' width="100%" height="350" type="application/pdf"></iframe>

			<input type="hidden" name="id" id="id" required value="{{$id}}">
			<textarea rows="2" cols="100" name="motivo" id="motivo" placeholder="Ingrese el motivo por el cual va realizar la corección del recibo seleccionado" required=""></textarea>
			<br><br>
			<a class="btn btn-danger" href="{{ url('/rrhh/lista_recibos' ) }}" role="button">Cancelar</a>
			<button type="submit" class="btn btn-success">Corregir</button>
		</div>
	</form>
</div>
@endsection
