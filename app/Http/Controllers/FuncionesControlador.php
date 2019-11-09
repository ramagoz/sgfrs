<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Grupo_recibo;
use App\Periodo;
use App\Persona;
use App\Recibo;
use App\Auditoria;
use App\Empleado_sin_recibo;
use App\Recibo_con_error;
use App\User;
use DB;
use DataTables;
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

    public function ControlEmpleadosSinRecibos ()
    {
               //inicio codigo control de empleados sin recibos
        $Personas = DB::table('personas')
        ->where('id_rol', '1')
        ->orWhere('id_rol', '2')
        ->orWhere('id_rol', '4')
        ->orWhere('id_rol', '5')
        ->get();

        $Periodos = DB::table('periodos')
        ->where('estado_periodo',0)
        ->get();

        foreach ($Personas as $persona)
        {
            foreach ($Periodos as $periodo)
            {

                $consulta1 = DB::table('recibos')
                ->where('id_periodo',$periodo->id_periodo)
                ->where('id_recibo',$persona->cedula.'-'.$periodo->mes.substr($periodo->año,2))
                ->first();

                if ($consulta1 ==NULL)//si esta en blanco le falta un recibo a la persona
                {
                    $consulta2 =DB::table('empleados_sin_recibos')
                    ->where('cedula',$persona->cedula)
                    ->where('id_periodo',$periodo->id_periodo)
                    ->first();

                    if ($consulta2 ==NULL)//si esta en blanco todavía no figura la persona en la tabla de personas sin recibos para este periodo en especifico y se carga en la BD
                    {
                        $empleados_sin_recibos = new Empleado_sin_recibo();
                        $empleados_sin_recibos->cedula = $persona->cedula;
                        $empleados_sin_recibos->id_periodo = $periodo->id_periodo;
                        $empleados_sin_recibos->save();
                    }
                }else //si la persona ya tiene un recibo para ese periodo se eliminan sus datos de la tabla de empleados sin recibos
                {
                    $consulta3 =DB::table('empleados_sin_recibos')
                    ->where('cedula',$persona->cedula)
                    ->where('id_periodo',$periodo->id_periodo)
                    ->first();

                    DB::table('empleados_sin_recibos')
                    ->where('cedula',$persona->cedula)
                    ->delete();                                            
                }
            }
        }
    //fin codigo control de empleados sin recibos
    }
}
