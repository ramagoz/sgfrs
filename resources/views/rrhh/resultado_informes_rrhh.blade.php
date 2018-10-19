@extends('layouts.app')
@section('content')
{{-- Dentro de section va el contenido de la vista--}}
	@include('layouts.menu_rrhh')
	<h3 align="center">INFORMES PARA RRHH</h1>
	<p align="center"><strong>Usuario: </strong> {{ Auth::user()->name }}, esta conectado con el Rol de <strong>Recursos Humanos</strong></p>
	<table id="example" class="display" style="width:90%" align="center" border="1">
		<thead>
		<tr><th>Año</th><th>Mes</th><th>Total Recibos</th><th>Firmados Empresa</th><th>Pendientes Firma Empresa</th><th>Firmados Empleados</th><th>Pendientes Firma Empleados</th><th>Estado Periodo</th></tr>
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
						@if ( $ene==0)
							Periodo no creado
						@elseif ( $ene ==($ene_firmado_empleado))
							Periodo Cerrado
						@else
							Periodo Abierto
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
						@if ( $feb==0)
							Periodo no creado
						@elseif ( $feb ==($feb_firmado_empleado))
							Periodo Cerrado
						@else
							Periodo Abierto
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
						@if ( $mar==0)
							Periodo no creado
						@elseif ( $mar ==($mar_firmado_empleado))
							Periodo Cerrado
						@else
							Periodo Abierto
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
						@if ( $abr==0)
							Periodo no creado
						@elseif ( $abr ==($abr_firmado_empleado))
							Periodo Cerrado
						@else
							Periodo Abierto
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
						@if ( $may==0)
							Periodo no creado
						@elseif ( $may ==($may_firmado_empleado))
							Periodo Cerrado
						@else
							Periodo Abierto
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
						@if ( $jun==0)
							Periodo no creado
						@elseif ( $jun ==($jun_firmado_empleado))
							Periodo Cerrado
						@else
							Periodo Abierto
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
						@if ( $jul==0)
							Periodo no creado
						@elseif ( $jul ==($jul_firmado_empleado))
							Periodo Cerrado
						@else
							Periodo Abierto
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
						@if ( $ago==0)
							Periodo no creado
						@elseif ( $ago ==($ago_firmado_empleado))
							Periodo Cerrado
						@else
							Periodo Abierto
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
						@if ( $set==0)
							Periodo no creado
						@elseif ( $set ==($set_firmado_empleado))
							Periodo Cerrado
						@else
							Periodo Abierto
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
						@if ( $oct==0)
							Periodo no creado
						@elseif ( $oct ==($oct_firmado_empleado))
							Periodo Cerrado
						@else
							Periodo Abierto
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
						@if ( $nov==0)
							Periodo no creado
						@elseif ( $nov ==($nov_firmado_empleado))
							Periodo Cerrado
						@else
							Periodo Abierto
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
						@if ( $dic==0)
							Periodo no creado
						@elseif ( $dic ==($dic_firmado_empleado))
							Periodo Cerrado
						@else
							Periodo Abierto
					 	@endif
					</td>
				</tr>

		</tbody>

	</table>

@endsection