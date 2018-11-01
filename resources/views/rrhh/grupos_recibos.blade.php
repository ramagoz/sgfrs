@extends('layouts.app')
@section('content')
{{-- Dentro de section va el contenido de la vista--}}
	@include('layouts.menu_rrhh')
	<h3 align="center">GRUPOS DE RECIBOS</h1>
	<p align="center"><strong>Usuario: </strong> {{ Auth::user()->name }}, esta conectado con el Rol de <strong>Recursos Humanos</strong></p>

	@isset($msj)
		<div class="alert alert-success" role="alert" align="center">{{ $msj }}</div>
	@endisset
	@isset($errormsj)
		<div class="alert alert-danger" role="alert" align="center">{{ $errormsj }}</div>
	@endisset

<form action="/rrhh/grupos_recibos" method="POST">	
{{ csrf_field() }}


<table border="1" align="center">

	<tr><th>Nombre Grupo</th><th>Ene</th><th>Feb</th><th>Mar</th><th>Abr</th><th>May</th><th>Jun</th><th>Jul</th><th>Ago</th><th>Set</th><th>Oct</th><th>Nov</th><th>Dic</th></tr>
	
    @foreach ($grupos as $grupo)
    <tr>
	<td>
		<strong>{{ $grupo->nombre_grupo }}</strong>
	</td>
	<td>
		{{ $grupo->ene }}
	</td>
	<td>
		{{ $grupo->feb }}
	</td>
	<td>
		{{ $grupo->mar }}
	</td>
	<td>
		{{ $grupo->abr }}
	</td>
	<td>
		{{ $grupo->may }}
	</td>
	<td>
		{{ $grupo->jun }}
	</td>
	<td>
		{{ $grupo->jul }}
	</td>
	<td>
		{{ $grupo->ago }}
	</td>
	<td>
		{{ $grupo->set }}
	</td>
	<td>
		{{ $grupo->oct }}
	</td>
	<td>
		{{ $grupo->nov }}
	</td>
	<td>
		{{ $grupo->dic }}
	</td>
	</tr>
	@endforeach

	<tr>
		<td><input type="text" name="nombre_grupo" id="nombre_grupo" maxlength="18" size="18" required value="{{ old('nombre_grupo') }}"></td></td>
		<td><input type="text" name="ene" id="ene"  maxlength="1" size="1" required value="{{ old('nombre_grupo') }}" ></td></td>
		<td><input type="text" name="feb" id="feb"  maxlength="1" size="1" required></td></td>
		<td><input type="text" name="mar" id="mar"  maxlength="1" size="1" required></td></td>
		<td><input type="text" name="abr" id="abr"  maxlength="1" size="1" required></td></td>
		<td><input type="text" name="may" id="may"  maxlength="1" size="1" required></td></td>
		<td><input type="text" name="jun" id="jun"  maxlength="1" size="1" required></td></td>
		<td><input type="text" name="jul" id="jul"  maxlength="1" size="1" required></td></td>
		<td><input type="text" name="ago" id="ago"  maxlength="1" size="1" required></td></td>
		<td><input type="text" name="set" id="set"  maxlength="1" size="1" required></td></td>
		<td><input type="text" name="oct" id="oct"  maxlength="1" size="1" required></td></td>
		<td><input type="text" name="nov" id="nov"  maxlength="1" size="1" required></td></td>
		<td><input type="text" name="dic" id="dic"  maxlength="1" size="1" required></td></td>
	</tr>
</div>

</form>
</table>
<br>
<div align="center">
<button class="btn btn-primary" type="submit" align="center">Crear Nuevo Grupo</button>
</div>
@endsection