<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Periodo;
use App\Persona;
use App\Recibo;
use App\Auditoria;
use DB;
use DataTables;
use App\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class FuncionesControlador extends Controller
{
    //funciones de apoyo
    public function getControlPeriodos()
    {   
        //inicio codigo control de los estados de los periodos
        //se obtiene la cantidad total de usuarios empleados del sistema
        $cantidad_empleados = DB::table('personas')
        ->where('id_rol', '1')
        ->orWhere('id_rol', '2')
        ->orWhere('id_rol', '4')
        ->orWhere('id_rol', '5')
        ->count();
        //se obtienen todos los periodos del sistema que están abiertos
        $todos_los_periodos = DB::table('periodos')
        ->where('estado_periodo', 0)
        ->get();
        //se recorre todos los periodos que existen y se compara la cantidad de recibos en un periodo con la cantidad de empleados del sistema, si la cantidad coincide se cambia el estado del periodo a cerrado "1"
        foreach ($todos_los_periodos as $periodo) 
        {
            $cantidad_recibos_periodo = DB::table('recibos')
            ->where('id_periodo', $periodo->id_periodo)
            ->where('id_estado_recibo', 3)
            ->count();
            if ($cantidad_recibos_periodo == $cantidad_empleados) 
            {
                $actualizacion_periodo = Periodo::find($periodo->id_periodo);
                $actualizacion_periodo->estado_periodo = 1;
                $actualizacion_periodo->save();
            }
        }//fin codigo control de los estados de los periodos
    }
}
