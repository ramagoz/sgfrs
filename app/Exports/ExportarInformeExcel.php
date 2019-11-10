<?php

namespace App\Exports;
use DB;
use App\Empleado_sin_recibo;
use App\Periodo;
use Maatwebsite\Excel\Concerns\FromCollection;

class EmpleadosSinRecibosExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
    	$resultado = DB::table('empleados_sin_recibos')
    	->join('periodos','empleados_sin_recibos.id_periodo','=','periodos.id_periodo')
    	->select('cedula as Cedula_Empleado','mes as Mes_Periodo','año as Año_Periodo')
    	->get();

    	return $resultado;
        //return Empleado_sin_recibo::all();
    }
}
