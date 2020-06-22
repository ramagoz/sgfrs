@extends('layouts.app')
@section('content')
@include('layouts.menu_rrhh')
<div class="container">
  <p></p>
	<div class="page-header">
	    <h2>Recibos Firmados Empresa y Empleados</h2>
	</div>
	  <p></p>

	<table class="table table-sm" border="1">
		<thead class="thead-dark">
			<tr>
				<th>Año</th>
				<th>Mes</th>
				<th>Total Recibos</th>
				<th>Firmados Empresa</th>
				<th>Pendientes Firma Empresa</th>
				<th>Firmados Empleados</th>
				<th>Pendientes Firma Empleados</th>
				<th>Estado Periodo</th>
			</tr>
		</thead>
		<tbody>
				<tr>
					<td>{{ $año }}</td>
					<td>Enero</td>
					<td>{{ $ene }}</td>
					<td>{{ $ene_firmado_empresa }}</td>
					<td>{{ $ene-$ene_firmado_empresa }}</td>
					<td>{{ $ene_firmado_empleado }}</td>
					<td>{{ $ene-$ene_firmado_empleado }}</td>
					<td>
						@if ( $existencia_ene==0)
							No creado
						@elseif ( $ene > 0 and $cantidad_empleados ==$ene_firmado_empleado)
							Cerrado
						@else
							Abierto
					 	@endif
					</td>
				</tr>


				<tr>
					<td>{{ $año }}</td>
					<td>Febrero</td>
					<td>{{ $feb }}</td>
					<td>{{ $feb_firmado_empresa }}</td>
					<td>{{ $feb-$feb_firmado_empresa }}</td>
					<td>{{ $feb_firmado_empleado }}</td>
					<td>{{ $feb-$feb_firmado_empleado }}</td>
					<td>
						@if ( $existencia_feb==0)
							No creado
						@elseif ( $feb > 0 and $cantidad_empleados ==$feb_firmado_empleado)
							Cerrado
						@else
							Abierto
					 	@endif
					</td>
				</tr>
				<tr>
					<td>{{ $año }}</td>
					<td>Marzo</td>
					<td>{{ $mar }}</td>
					<td>{{ $mar_firmado_empresa }}</td>
					<td>{{ $mar-$mar_firmado_empresa }}</td>
					<td>{{ $mar_firmado_empleado }}</td>
					<td>{{ $mar-$mar_firmado_empleado }}</td>
					<td>
						@if ( $existencia_mar==0)
							No creado
						@elseif ( $mar > 0 and $cantidad_empleados ==$mar_firmado_empleado)
							Cerrado
						@else
							Abierto
					 	@endif
					</td>
				</tr>
				<tr>
					<td>{{ $año }}</td>
					<td>Abril</td>
					<td>{{ $abr }}</td>
					<td>{{ $abr_firmado_empresa }}</td>
					<td>{{ $abr-$abr_firmado_empresa }}</td>
					<td>{{ $abr_firmado_empleado }}</td>
					<td>{{ $abr-$abr_firmado_empleado }}</td>
					<td>
						@if ($existencia_abr==0)
							No creado
						@elseif ( $abr > 0 and $cantidad_empleados ==$abr_firmado_empleado)
							Cerrado
						@else
							Abierto
					 	@endif
					</td>
				</tr>
				<tr>
					<td>{{ $año }}</td>
					<td>Mayo</td>
					<td>{{ $may }}</td>
					<td>{{ $may_firmado_empresa }}</td>
					<td>{{ $may-$may_firmado_empresa }}</td>
					<td>{{ $may_firmado_empleado }}</td>
					<td>{{ $may-$may_firmado_empleado }}</td>
					<td>
						@if ( $existencia_may==0)
							No creado
						@elseif ( $may > 0 and $cantidad_empleados ==$may_firmado_empleado)
							Cerrado
						@else
							Abierto
					 	@endif
					</td>
				</tr>
				<tr>
					<td>{{ $año }}</td>
					<td>Junio</td>
					<td>{{ $jun }}</td>
					<td>{{ $jun_firmado_empresa }}</td>
					<td>{{ $jun-$jun_firmado_empresa }}</td>
					<td>{{ $jun_firmado_empleado }}</td>
					<td>{{ $jun-$jun_firmado_empleado }}</td>
					<td>
						@if ( $existencia_jun==0)
							No creado
						@elseif ( $jun > 0 and $cantidad_empleados ==$jun_firmado_empleado)
							Cerrado
						@else
							Abierto
					 	@endif
					</td>
				</tr>
				<tr>
					<td>{{ $año }}</td>
					<td>Julio</td>
					<td>{{ $jul }}</td>
					<td>{{ $jul_firmado_empresa }}</td>
					<td>{{ $jul-$jul_firmado_empresa }}</td>
					<td>{{ $jul_firmado_empleado }}</td>
					<td>{{ $jul-$jul_firmado_empleado }}</td>
					<td>
						@if ( $existencia_jul==0)
							No creado
						@elseif ( $jul > 0 and $cantidad_empleados ==$jul_firmado_empleado)
							Cerrado
						@else
							Abierto
					 	@endif
					</td>
				</tr>
				<tr>
					<td>{{ $año }}</td>
					<td>Agosto</td>
					<td>{{ $ago }}</td>
					<td>{{ $ago_firmado_empresa }}</td>
					<td>{{ $ago-$ago_firmado_empresa }}</td>
					<td>{{ $ago_firmado_empleado }}</td>
					<td>{{ $ago-$ago_firmado_empleado }}</td>
					<td>
						@if ( $existencia_ago==0)
							No creado
						@elseif ( $ago > 0 and $cantidad_empleados ==$ago_firmado_empleado)
							Cerrado
						@else
							Abierto
					 	@endif
					</td>
				</tr>
				<tr>
					<td>{{ $año }}</td>
					<td>Setiembre</td>
					<td>{{ $set }}</td>
					<td>{{ $set_firmado_empresa }}</td>
					<td>{{ $set-$set_firmado_empresa }}</td>
					<td>{{ $set_firmado_empleado }}</td>
					<td>{{ $set-$set_firmado_empleado }}</td>
					<td>
						@if ( $existencia_set==0)
							No creado
						@elseif ( $set > 0 and $cantidad_empleados ==$set_firmado_empleado)
							Cerrado
						@else
							Abierto
					 	@endif
					</td>
				</tr>
				<tr>
					<td>{{ $año }}</td>
					<td>Octubre</td>
					<td>{{ $oct }}</td>
					<td>{{ $oct_firmado_empresa }}</td>
					<td>{{ $oct-$oct_firmado_empresa }}</td>
					<td>{{ $oct_firmado_empleado }}</td>
					<td>{{ $oct-$oct_firmado_empleado }}</td>
					<td>
						@if ( $existencia_oct==0)
							No creado
						@elseif ( $oct > 0 and $cantidad_empleados ==$oct_firmado_empleado)
							Cerrado
						@else
							Abierto
					 	@endif
					</td>
				</tr>
				<tr>
					<td>{{ $año }}</td>
					<td>Noviembre</td>
					<td>{{ $nov }}</td>
					<td>{{ $nov_firmado_empresa }}</td>
					<td>{{ $nov-$nov_firmado_empresa }}</td>
					<td>{{ $nov_firmado_empleado }}</td>
					<td>{{ $nov-$nov_firmado_empleado }}</td>
					<td>
						@if ( $existencia_nov==0)
							No creado
						@elseif ( $nov > 0 and $cantidad_empleados ==$nov_firmado_empleado)
							Cerrado
						@else
							Abierto
					 	@endif
					</td>
				</tr>
				<tr>
					<td>{{ $año }}</td>
					<td>Diciembre</td>
					<td>{{ $dic }}</td>
					<td>{{ $dic_firmado_empresa }}</td>
					<td>{{ $dic-$dic_firmado_empresa }}</td>
					<td>{{ $dic_firmado_empleado }}</td>
					<td>{{ $dic-$dic_firmado_empleado }}</td>
					<td>
						@if ( $existencia_dic==0)
							No creado
						@elseif ( $dic > 0 and $cantidad_empleados ==$dic_firmado_empleado)
							Cerrado
						@else
							Abierto
					 	@endif
					</td>
				</tr>
		</tbody>
	</table>

	<a class="btn btn-primary"  href="{{ url('/rrhh/informes_rrhh' ) }}" role="button">Volver</a>
	<a class="btn btn-success"  href="{{ url('rrhh/pdf/'.$año) }}" role="button">Exportar en PDF</a>

</div>
@endsection