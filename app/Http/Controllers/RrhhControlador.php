<?php

namespace App\Http\Controllers;

use App\Grupo_recibo;
use App\Periodo;
use App\Persona;
use App\Recibo;
use DB;
use Illuminate\Http\Request;

class RrhhControlador extends Controller
{
    public function getIndexRrhh()
    {
        return view('rrhh.indexrrhh');
    }
    public function getAltaEmpleado()
    {
        //Consulta DB para ver grupos disponibles los compacta en de array y los envia a la vista//
        $nombre_grupos = DB::table('grupos_recibos')->select('nombre_grupo','id_grupo')->get();
        return view('rrhh.alta_empleado', compact('nombre_grupos'));
    }
    public function postEmpleadoCargado(Request $request)
    {
       /*consulta a la tabla de usuario y trae el resultado que coinncide con el correo que se cargo para relacionar tabla de usuario con la tabla de persona*/
        $usuario = DB::table('users')->where('email', $request->correo)->get()->toArray();
        foreach ($usuario as $users) {

            $id = $users->id;
        }

        $persona             = new Persona();
        $persona->id_usuario = $id;
        $persona->id_grupo   = $request->grupo;
        $persona->nombres    = $request->nombre;
        $persona->apellidos  = $request->apellido;
        $persona->cedula     = $request->cedula;
        $persona->cel        = $request->celular;
        $persona->tel        = $request->telefono;
        $persona->dpto       = $request->dpto;
        $persona->cargo      = $request->cargo;
        $persona->correo     = $request->correo;
        $persona->estado     = $request->estado;
        $persona->obs        = $request->observacion;
        $persona->save();
        return view('rrhh.empleado_cargado');
    }
    public function getBajaEmpleado()
    {
        return view('rrhh.baja_empleado');
    }
    public function getModificacionEmpleado(Request $request, $id_usuario)
    {
       # $id="13";
        $persona =DB::table('personas')->where('id_usuario',$id_usuario)->get()->toArray();
        $nombre_grupos = DB::table('grupos_recibos')->select('nombre_grupo','id_grupo')->get();
        return view('rrhh.modificacion_empleado', compact('persona'),compact('nombre_grupos'));
    }
    public function getEmpleadoModificado(Request $request)
    {   
      
        $persona =Persona::find($request->cedula);
    
        $persona->id_grupo   = $request->grupo;
        $persona->nombres    = $request->nombre;
        $persona->apellidos  = $request->apellido;
        $persona->cedula     = $request->cedula;
        $persona->cel        = $request->celular;
        $persona->tel        = $request->telefono;
        $persona->dpto       = $request->dpto;
        $persona->cargo      = $request->cargo;
        $persona->correo     = $request->correo;
        $persona->estado     = $request->estado;
        $persona->obs        = $request->observacion;
       
        $persona->save();
        return view('rrhh.empleado_cargado');
        
    }
    public function getBusquedaEmpleado()
    {
        $datos_empleados = DB::table('personas')->get();
        return view('rrhh.busqueda_empleado', compact('datos_empleados'));

    }
    public function getCrearNuevoPeriodo()
    {
        return view('rrhh.crear_nuevo_periodo');
    }
    public function getCrear(Request $request)
    {
        $periodo                 = new Periodo();
        $periodo->estado_periodo = 0;
        $periodo->fecha          = $request->año . '-' . $request->mes . '-01';
        $periodo->save();
        $estructura_carpetas_nuevos                     = 'C:/xampp/htdocs/sgfrs/public/recibos/nuevos/' . $request->año . '/' . $request->mes;
        $estructura_carpetas_pendientes                 = 'C:/xampp/htdocs/sgfrs/public/recibos/pendientes/' . $request->año . '/' . $request->mes;
        $estructura_carpetas_firmados_empresa           = 'C:/xampp/htdocs/sgfrs/public/recibos/firmados_empresa/' . $request->año . '/' . $request->mes;
        $estructura_carpetas_firmados_empresa_empleados = 'C:/xampp/htdocs/sgfrs/public/recibos/firmados_empresa_empleados/' . $request->año . '/' . $request->mes;
        mkdir($estructura_carpetas_nuevos, 0777, true);
        mkdir($estructura_carpetas_pendientes, 0777, true);
        mkdir($estructura_carpetas_firmados_empresa, 0777, true);
        mkdir($estructura_carpetas_firmados_empresa_empleados, 0777, true);
        return view('rrhh.periodo_creado');
    }
    public function getValidarRecibos()
    {
        return view('rrhh.validar_recibos');
    }
    public function postValidarRecibos(Request $request)
    {
        $mes                = $request->mes; //se obtiene el mes del periodo a validar
        $año               = $request->año; //se obtiene el año del periodo a validar
        $cantidad_empleados = DB::table('users')->where('id_rol', '1')->orWhere('id_rol', '2')->orWhere('id_rol', '4')->orWhere('id_rol', '5')->count();
        $periodo            = 1; //se obtiene la cantidad de usuarios que son empleados
        $dir                = "C:/xampp/htdocs/sgfrs/public/recibos/nuevos/" . $año . "/" . $mes . "/"; //se define la direccion del directorio que sera validado
        $a                  = 0;
        $b                  = 0;
        $c                  = 0;
        $d                  = 0;
        $e                  = 0; //contadores de datos
        foreach (scandir($dir) as $f) //esta funcion permite leer el nombre de los archivos contenidos segun directorio especificado y los guarda en la variable $f por cada pasada de la iteraccion hasta leer todos los archivos del directorio
        {
            if ($f !== '.' and $f !== '..') // se descarta los elementos "." y ".." ya que no son archivos
            {
                $e++; //contador de cantidad de archivos procesados
                if (strtolower(substr($f, -4)) == '.pdf') //se controlar si la extension del archivo es .pdf
                {
                    if (substr($f, -9, 3) == "-" . $mes and substr($f, -6, 2) == substr($año, -2))
                    //se verifica si el mes y año corresponde con el que se quiere importar
                    {
                        $cedula  = substr($f, 0, (strlen($f) - 9));
                        $persona = Persona::find($cedula);
                        if (!empty($persona)) //se verificar que el numero de cedula corresponda con algun usuario del sistema (luego faltaria validar que el numero de cedula solo sea para usuarios que tienen el rol de empleado)
                        {
                            $recibos[$a] = $f;
                            $a++;
                        } else {
//aqui se guardan los recibos que el numero de cedula no corresponde
                            $recibo_error_cedula[$d] = $f;
                            $d++;
                        }
                    } else {
//aqui se guardan los recibos que estan mal su periodo
                        $recibo_error_periodo[$b] = $f;
                        $b++;
                    }
                } else {
//aqui se guardan los recibos que estan mal su extension
                    $recibo_error_extension[$c] = $f;
                    $c++;
                }
            }
        }
        if ($a > 0) //aqui se guardan la cantidad de recibos correctos que fueron procesados
        {
            $resultado[0] = count($recibos);
        } else {
            $resultado[0] = 0;
        }
        if ($b > 0) //aqui se guardan la cantidad de recibos con error de periodo
        {
            $resultado[1] = count($recibo_error_periodo);
        } else {
            $resultado[1] = 0;
        }
        if ($c > 0) //aqui se guardan la cantidad de recibos con error de extension
        {
            $resultado[2] = count($recibo_error_extension);
        } else {
            $resultado[2] = 0;
        }
        if ($d > 0) //aqui se guardan la cantidad de recibos con número de cedula no encontrado en el sistema
        {
            $resultado[3] = count($recibo_error_cedula);
        } else {
            $resultado[3] = 0;
        }
        if ($a > 0) //aqui se guardan la cantidad de recibos con número de cedula no encontrado en el sistema
        {
            $recibos_correctos = count($recibos);
            $resultado[4]      = $cantidad_empleados - $recibos_correctos;
        } else {
            $resultado[4] = 0;
        }
        $resultado[5] = $e; //aqui se guardan la cantidad de archivos que fueron procesados
        return view('rrhh.resultado_validacion')->with('resultados', $resultado); //se envia los resultados de la validacion a la vista
    }
    public function getImportarRecibos()
    {
        return view('rrhh.importar_recibos');
    }
    public function getRecibosImportados(Request $request)
    {
        $mes                = $request->mes; //se obtiene el mes del periodo a validar
        $año               = $request->año; //se obtiene el año del periodo a validar
        $cantidad_empleados = DB::table('users')->where('id_rol', '1')->orWhere('id_rol', '2')->orWhere('id_rol', '4')->orWhere('id_rol', '5')->count();//se obtiene la cantidad de usuarios que son empleados
        $periodo            = 1; //por defecto al crear un perior el mismo se encuentra abierto, es decir con codigo 1
        $dir                = "C:/xampp/htdocs/sgfrs/public/recibos/nuevos/" . $año . "/" . $mes . "/"; //se define la direccion del directorio que sera validado
        $a                  = 0;
        $b                  = 0;
        $c                  = 0;
        $d                  = 0;
        $e                  = 0; //contadores de datos
        foreach (scandir($dir) as $f) //esta funcion permite leer el nombre de los archivos contenidos segun directorio especificado y los guarda en la variable $f por cada pasada de la iteraccion hasta leer todos los archivos del directorio
        {
            if ($f !== '.' and $f !== '..') // se descarta los elementos "." y ".." ya que no son archivos
            {
                $e++; //contador de cantidad de archivos procesados
                if (strtolower(substr($f, -4)) == '.pdf') //se controlar si la extension del archivo es .pdf
                {
                    if (substr($f, -9, 3) == "-" . $mes and substr($f, -6, 2) == substr($año, -2))
                    //se verifica si el mes y año corresponde con el que se quiere importar
                    {
                        $cedula  = substr($f, 0, (strlen($f) - 9));
                        $persona = Persona::find($cedula);
                        if (!empty($persona)) //se verificar que el numero de cedula corresponda con algun usuario del sistema (luego faltaria validar que el numero de cedula solo sea para usuarios que tienen el rol de empleado)
                        {
                            $recibos[$a] = $f;
                            $a++;
                            $Recibo                   = new Recibo();
                            $Recibo->id_recibo        = substr($f, 0, -4);
                            $Recibo->id_estado_recibo = 2;
                            $Recibo->cedula           = $cedula;
                            $Recibo->id_periodo       = $periodo;
                            $Recibo->save();
                            rename($dir . $f, "C:/xampp/htdocs/sgfrs/public/recibos/pendientes/" . $año . "/" . $mes . "/" . $f);
                        } else {
//aqui se guardan los recibos que el numero de cedula no corresponde
                            $recibo_error_cedula[$d] = $f;
                            $d++;
                        }
                    } else {
//aqui se guardan los recibos que estan mal su periodo
                        $recibo_error_periodo[$b] = $f;
                        $b++;
                    }
                } else {
//aqui se guardan los recibos que estan mal su extension
                    $recibo_error_extension[$c] = $f;
                    $c++;
                }
            }
        }
        if ($a > 0) //aqui se guardan la cantidad de recibos correctos que fueron procesados
        {
            $resultado[0] = count($recibos);
        } else {
            $resultado[0] = 0;
        }
        if ($b > 0) //aqui se guardan la cantidad de recibos con error de periodo
        {
            $resultado[1] = count($recibo_error_periodo);
        } else {
            $resultado[1] = 0;
        }
        if ($c > 0) //aqui se guardan la cantidad de recibos con error de extension
        {
            $resultado[2] = count($recibo_error_extension);
        } else {
            $resultado[2] = 0;
        }
        if ($d > 0) //aqui se guardan la cantidad de recibos con número de cedula no encontrado en el sistema
        {
            $resultado[3] = count($recibo_error_cedula);
        } else {
            $resultado[3] = 0;
        }
        if ($a > 0) //aqui se guardan la cantidad de recibos con número de cedula no encontrado en el sistema
        {
            $recibos_correctos = count($recibos);
            $resultado[4]      = $cantidad_empleados - $recibos_correctos;
        } else {
            $resultado[4] = 0;
        }
        $resultado[5] = $e; //aqui se guardan la cantidad de archivos que fueron procesados
        return view('rrhh.recibos_importados')->with('resultados', $resultado); //se envia los resultados de la validacion a la vista
    }
    public function getEmpleadosSinRecibos()
    {
        return view('rrhh.empleados_sin_recibos');
    }
    public function getCorregirRecibos()
    {
        return view('rrhh.corregir_recibos');
    }
    public function getGruposRecibos()
    {
        $grupos = DB::table('grupos_recibos')->get();

        return view('rrhh.grupos_recibos')->with('grupos', $grupos);
    }
    public function postCrearGrupoRecibo(Request $request)
    {
        $grupo               = new Grupo_recibo;
        $grupo->nombre_grupo = $request->nombre_grupo;
        $grupo->ene          = $request->ene;
        $grupo->feb          = $request->feb;
        $grupo->mar          = $request->mar;
        $grupo->abr          = $request->abr;
        $grupo->may          = $request->may;
        $grupo->jun          = $request->jun;
        $grupo->jul          = $request->jul;
        $grupo->ago          = $request->ago;
        $grupo->set          = $request->set;
        $grupo->oct          = $request->oct;
        $grupo->nov          = $request->nov;
        $grupo->dic          = $request->dic;
        $grupo->save();
        return back();
    }
    public function getPendientesFirmaEmpresa()
    {
        $recibos = DB::table('recibos')
        ->join('personas', 'recibos.cedula','=','personas.cedula')
        ->where('recibos.id_estado_recibo', '2')
        ->get();

        return view('rrhh.pendientes_firma_empresa')->with('recibos',$recibos);
    }
    public function getVerRecibo($id)
    {
        $id="/recibos/pendientes/"."20".substr($id, -2, 2)."/".substr($id, -4, 2)."/".$id.".pdf";
        return view('rrhh.ver_recibo')->with('id',$id);
    }
    public function getPendientesFirmaEmpleados()
    {
        $recibos = DB::table('recibos')
        ->join('personas', 'recibos.cedula','=','personas.cedula')
        ->where('recibos.id_estado_recibo', '3')
        ->get();

        return view('rrhh.pendientes_firma_empleados')->with('recibos',$recibos);
    }
    public function getVerReciboPendientesFirmaEmpleados($id)
    {
        $id="/recibos/firmados_empresa/"."20".substr($id, -2, 2)."/".substr($id, -4, 2)."/".$id.".pdf";
        return view('rrhh.ver_recibo_pendientes_firma_empleados')->with('id',$id);
    }
    public function getFirmadosEmpresaEmpleados()
    {
        $recibos = DB::table('recibos')
        ->join('personas', 'recibos.cedula','=','personas.cedula')
        ->where('recibos.id_estado_recibo', '4')
        ->get();

        return view('rrhh.firmados_empresa_empleados')->with('recibos',$recibos);

    }
    public function getVerReciboFirmadoEmpresaEmpleado($id)
    {
        $id="/recibos/firmados_empresa_empleados/"."20".substr($id, -2, 2)."/".substr($id, -4, 2)."/".$id.".pdf";
        return view('rrhh.ver_recibo_firmados_empresa_empleados')->with('id',$id);
    }
    public function getTodosLosRecibos()
    {
        $recibos = DB::table('recibos')
        ->join('personas', 'recibos.cedula','=','personas.cedula')
        ->where('recibos.id_estado_recibo', '2')
        ->orWhere('recibos.id_estado_recibo', '3')
        ->orWhere('recibos.id_estado_recibo', '4')
        ->get();

        return view('rrhh.todos_los_recibos')->with('recibos',$recibos);
    }
    public function getVerTodosLosRecibos($id)
    {
        $consulta = DB::table('recibos')
        ->where('id_recibo',$id)
        ->first();
        switch ($consulta->id_estado_recibo) 
        {
            case 2:
                $id="/recibos/pendientes/"."20".substr($id, -2, 2)."/".substr($id, -4, 2)."/".$id.".pdf";
                return view('rrhh.ver_todos_los_recibos')->with('id',$id);
            break;
            case 3:
                $id="/recibos/firmados_empresa/"."20".substr($id, -2, 2)."/".substr($id, -4, 2)."/".$id.".pdf";
                return view('rrhh.ver_todos_los_recibos')->with('id',$id);
            break;            
            case 4:
                $id="/recibos/firmados_empresa_empleados/"."20".substr($id, -2, 2)."/".substr($id, -4, 2)."/".$id.".pdf";
                return view('rrhh.ver_todos_los_recibos')->with('id',$id);
            break; 
        }
    }
    public function getInformesRrhh()
    {
        $recibos = DB::table('recibos')->get();
        foreach ($recibos as $recibo) 
        {
            echo $recibo->id_recibo;
        }

        return view('rrhh.informes_rrhh');
    }
    public function getCambiarContraseña()
    {
        return view('rrhh.cambiar_contraseña');
    }
}
