<?php

namespace App\Exports;
use DB;
use App\Empleado_sin_recibo;
use App\Periodo;
use App\Persona;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;

class EmpleadosSinRecibosExport implements FromView
{
	use Exportable;

    public function view(): View
    {
    	$resultados = DB::table('empleados_sin_recibos')
    	->join('periodos','empleados_sin_recibos.id_periodo','=','periodos.id_periodo')
    	->join('personas','personas.cedula','=','empleados_sin_recibos.cedula')
    	->get();

    	return view('rrhh.informeexcel')->with('resultados',$resultados);
    }
}