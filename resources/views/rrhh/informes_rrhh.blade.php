@extends('layouts.app')
@include('layouts.menu_rrhh')
@section('content')
{{-- Dentro de section va el contenido de la vista--}}

	<h3 align="center">SELECCIONAR AÑO DEL INFORME</h1>
	@if(isset($boton))
	<form action="/rrhh/resultado_informes_rrhh" method="POST">
	{{csrf_field()}}

	<div align="center" id="prueba">

	<table style="width:20%" >
			<tr>
				<th>Año:</th>
				<td>
					<select class="form-control" id="año" name="año" maxlength="4" required>
						@foreach($años as $año)
				            <option value="{{$año->año}}">
				                {{$año->año}}
				            </option>
			            @endforeach
					</select>
				</td>
			</tr>
	</table>
	<br>
	<button class="btn btn-primary" type="submit">Ver Informe</button>
	@endif
	</div>
	</form>


	@if(isset($msj))
		<div class="alert alert-warning" role="alert" align="center">{{ $msj }}</div>
	@endif

@endsection