<table>
	<tr>
		<th>Cédula</th>
		<th>Nombres</th>
		<th>Apellidos</th>
		<th>Correo</th>
		<th>Tel.</th>
		<th>Celular</th>
		<th>Mes del periodo</th>
		<th>Año del periodo</th>
	</tr>
	@foreach($resultados as $resultado)
	<tr>
		<td> {{ $resultado->cedula}} </td>
		<td> {{ $resultado->nombres}} </td>
		<td> {{ $resultado->apellidos}} </td>
		<td> {{ $resultado->correo}} </td>
		<td> {{ $resultado->tel}} </td>
		<td> {{ $resultado->cel}} </td>
		<td> {{ $resultado->mes}} </td>
		<td> {{ $resultado->año}} </td>
	</tr>
	@endforeach
</table>