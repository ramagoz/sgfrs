@extends('layouts.app')
@section('content')
{{-- Dentro de section va el contenido de la vista--}}
	@include('layouts.menu_empresa')
	<h3 align="center">INFORMES EMPRESA</h1>
	<p align="center"><strong>Usuario: </strong> {{ Auth::user()->name }}, esta conectado con el Rol de <strong>Empresa</strong></p>

	@if(isset($boton))
	<form action="/empresa/resultado_informes_empresa" method="POST">	
	{{csrf_field()}}

	<div align="center" id="prueba">
	<table style="width:20%" >		
			<tr> 
				<th>Año:</th>
				<td>
					<select class="form-control" id="año" name="año">
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
	</div>
	</form>
	@endif
	
	@if(isset($msj))
		<div class="alert alert-warning" role="alert" align="center">{{ $msj }}</div>
	@endif

@endsection