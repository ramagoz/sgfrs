<?php
namespace App\Http\Controllers;
use App\Auditoria;
use App\Empleado_sin_recibo;
use App\Exports\EmpleadosSinRecibosExport;
use App\Http\Requests\ValidacionCargaUsuario;
use App\Http\Requests\ValidacionActualizacionUsuario;
use App\Http\Requests\ValidacionPeriodo;
use App\Grupo_recibo;
use App\Http\Controllers\Controller;
use App\Http\Controllers\FuncionesControlador;
use App\Periodo;
use App\Persona;
use App\Recibo;
use App\Recibo_con_error;
use App\User;
use Auth;
use Barryvdh\DomPDF\Facade as PDF;
use DB;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Validator;
use Ping;



//prueba de nuevo contribuidor

class RrhhControlador extends Controller
{
    public function getIndexRrhh()
    {
        //esta funcion controla si se cierran los periodos
        $resultado = (new FuncionesControlador)->getControlPeriodos();

        return view('rrhh.indexrrhh');
    }
    public function datatable()//Devuelve los datos de los empleados para el datatable
    {
         $persona_rol= DB::table('personas')->where('id_rol', '1')->get();
         //return Datatables::of(Persona::query())->make(true);
         return Datatables::of($persona_rol)->make(true);
    }
    public function getBusquedaEmpleado()//ok
    {
        $datos= DB::table('personas')->where('id_rol', '2')->count();
        if ($datos > 0)
        {
            return view('rrhh.busqueda_empleado');
        }
        else
        {
            return view('rrhh.busqueda_empleadoh')->with('error', 'No existen usuarios con rol de RRHH');
        }
    }
    public function getAltaEmpleado()//ok
    {

        return view('rrhh.alta_empleado');
    }
    public function postEmpleadoCargado(ValidacionCargaUsuario $request)//ok
    {
        //Validación de datos obtenidos del formulario se realiza con la clase ValidacionCargaUsuario
        //creacion de usuario
        $user = new User();
        $user->name = $request->nombre;
        $user->email = $request->correo;
        $user->status= '1';
        $user->password = Hash::make($request->cedula);
        $user->save();
        //creacion de persona relacionada al usuario que se creo previamente.
        $usuario = DB::table('users')->where('email', $request->correo)->get()->toArray();
        foreach ($usuario as $users)
        {
          $id = $users->id;
        }
        $persona             = new Persona();
        $persona->id_usuario = $id;
        $persona->id_rol     = 1;
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

        //inicio codigo auditoria
            $auditoria = new Auditoria();
            $auditoria->fecha_hora = date('Y-m-d H:i:s');
            $auditoria->cedula = session()->get('cedula_usuario');
            $auditoria->rol = session()->get('rol_usuario');
            $auditoria->ip = session()->get('ip_usuario');
            $auditoria->operacion = "Alta de empleado";
            $auditoria->descripcion = "Se procedio a la alta en el sistema del usuario con rol de empleado con los siguientes datos:"."\n"
            ."número de cédula: ".$request->cedula."\n"
            ."Nombre: ".$request->nombre."\n"
            ."Apellido: ".$request->apellido."\n"
            ."Cel.: ".$request->celular."\n"
            ."Tel.: ".$request->telefono."\n"
            ."Correo: ".$request->correo."\n"
            ."Dpto.: ".$request->dpto."\n"
            ."Cargo: ".$request->cargo."\n"
            ."Obs.: ".$request->observacion;
            $auditoria->save();
        //fin codigo auditoria

        return view('rrhh.busqueda_empleado')->with('msj','Se un registro el usuario con CI Nro. '.$request->cedula);
    }
    public function getModificacionEmpleado($cedula)//ok
    {

        $persona =DB::table('personas')->where('cedula',$cedula)->first();
        return view('rrhh.modificacion_empleado', compact('persona'));
    }
    public function postEmpleadoModificado(ValidacionActualizacionUsuario $request)//ok
    {
      $persona =Persona::find($request->cedula);
      $consulta = DB::table('personas')->where('correo',$request->correo)->get();
      if ($persona->correo <> $request->correo and $consulta <> '[]')
      {
          return view('rrhh.modificacion_empleado')->with('error','Este correo ya esta asignado a otro usuario')->with('persona',$request);
      }
      $persona->cedula     = $request->cedula;
      $persona->nombres    = $request->nombres;
      $persona->apellidos  = $request->apellidos;
      $persona->cel        = $request->cel;
      $persona->tel        = $request->tel;
      $persona->dpto       = $request->dpto;
      $persona->cargo      = $request->cargo;
      $persona->correo     = $request->correo;
      $persona->estado     = $request->estado;
      $persona->obs        = $request->obs;
      $persona->save();

      $user =User::find($request->id_usuario);
      $user->email = $request->correo;
      $user->status = $request->estado;
      $user->save();

        //inicio codigo auditoria
        $auditoria = new Auditoria();
        $auditoria->fecha_hora = date('Y-m-d H:i:s');
        $auditoria->cedula = session()->get('cedula_usuario');
        $auditoria->rol = session()->get('rol_usuario');
        $auditoria->ip = session()->get('ip_usuario');
        $auditoria->operacion = "Modificación datos empleado";
        if($request->estado ==1) {$estado="Activo";}else{$estado="Inactivo";}
        $auditoria->descripcion = "Se procedio a la modificación de datos del usuario con rol de empleado, datos actualizados:"."\n"
        ."número de cédula: ".$request->cedula."\n"
        ."Nombre: ".$request->nombre."\n"
        ."Apellido: ".$request->apellido."\n"
        ."Cel.: ".$request->celular."\n"
        ."Tel.: ".$request->telefono."\n"
        ."Correo: ".$request->correo."\n"
        ."Dpto.: ".$request->dpto."\n"
        ."Cargo: ".$request->cargo."\n"
        ."Estado: ".$estado."\n"
        ."Obs.: ".$request->observacion;
        $auditoria->save();
        //fin codigo auditoria

        return view('/rrhh/busqueda_empleado')->with('msj','Los datos del usuario con CI Nro. '.$request->cedula.' se actualizaron correctamente!!!');
    }
    public function getPdf($id)
    {
        $recibos = DB::table('recibos')
       ->join('periodos', 'recibos.id_periodo','=','periodos.id_periodo')
       ->where('periodos.año',$id)
       ->get();

        $cantidad_empleados = DB::table('personas')->where('id_rol', '1')->orWhere('id_rol', '2')->orWhere('id_rol', '4')->orWhere('id_rol', '5')->count();

        $ene=0; $feb=0; $mar=0; $abr=0; $may=0; $jun=0;
        $jul=0; $ago=0; $set=0; $oct=0; $nov=0; $dic=0;
        $ene_firmado_empresa=0;$feb_firmado_empresa=0;
        $mar_firmado_empresa=0;$abr_firmado_empresa=0;
        $may_firmado_empresa=0;$jun_firmado_empresa=0;
        $jul_firmado_empresa=0;$ago_firmado_empresa=0;
        $set_firmado_empresa=0;$oct_firmado_empresa=0;
        $nov_firmado_empresa=0;$dic_firmado_empresa=0;
        $ene_firmado_empleado=0;$feb_firmado_empleado=0;
        $mar_firmado_empleado=0;$abr_firmado_empleado=0;
        $may_firmado_empleado=0;$jun_firmado_empleado=0;
        $jul_firmado_empleado=0;$ago_firmado_empleado=0;
        $set_firmado_empleado=0;$oct_firmado_empleado=0;
        $nov_firmado_empleado=0;$dic_firmado_empleado=0;
        foreach ($recibos as $recibo)
        {
            switch ($recibo->mes)
            {
                case 1:
                    $ene++;
                    if ($recibo->id_estado_recibo==2 or $recibo->id_estado_recibo==3)
                    {
                        $ene_firmado_empresa++;
                    }
                    if ($recibo->id_estado_recibo==3)
                    {
                        $ene_firmado_empleado++;
                    }
                break;
                case 2:
                    $feb++;
                    if ($recibo->id_estado_recibo==2 or $recibo->id_estado_recibo==3)
                    {
                        $feb_firmado_empresa++;
                    }
                    if ($recibo->id_estado_recibo==3)
                    {
                        $feb_firmado_empleado++;
                    }
                break;
                case 3:
                    $mar++;
                    if ($recibo->id_estado_recibo==2 or $recibo->id_estado_recibo==3)
                    {
                        $mar_firmado_empresa++;
                    }
                    if ($recibo->id_estado_recibo==3)
                    {
                        $mar_firmado_empleado++;
                    }
                break;
                case 4:
                    $abr++;
                    if ($recibo->id_estado_recibo==2 or $recibo->id_estado_recibo==3)
                    {
                        $abr_firmado_empresa++;
                    }
                    if ($recibo->id_estado_recibo==3)
                    {
                        $abr_firmado_empleado++;
                    }
                break;
                case 5:
                    $may++;
                    if ($recibo->id_estado_recibo==2 or $recibo->id_estado_recibo==3)
                    {
                        $may_firmado_empresa++;
                    }
                    if ($recibo->id_estado_recibo==3)
                    {
                        $may_firmado_empleado++;
                    }
                break;
                case 6:
                    $jun++;
                    if ($recibo->id_estado_recibo==2 or $recibo->id_estado_recibo==3)
                    {
                        $jun_firmado_empresa++;
                    }
                    if ($recibo->id_estado_recibo==3)
                    {
                        $jun_firmado_empleado++;
                    }
                break;
                case 7:
                    $jul++;
                    if ($recibo->id_estado_recibo==2 or $recibo->id_estado_recibo==3)
                    {
                        $jul_firmado_empresa++;
                    }
                    if ($recibo->id_estado_recibo==3)
                    {
                        $jul_firmado_empleado++;
                    }
                break;
                case 8:
                    $ago++;
                    if ($recibo->id_estado_recibo==2 or $recibo->id_estado_recibo==3)
                    {
                        $ago_firmado_empresa++;
                    }
                    if ($recibo->id_estado_recibo==3)
                    {
                        $ago_firmado_empleado++;
                    }
                break;
                case 9:
                    $set++;
                    if ($recibo->id_estado_recibo==2 or $recibo->id_estado_recibo==3)
                    {
                        $set_firmado_empresa++;
                    }
                    if ($recibo->id_estado_recibo==3)
                    {
                        $set_firmado_empleado++;
                    }
                break;
                case 10:
                    $oct++;
                    if ($recibo->id_estado_recibo==2 or $recibo->id_estado_recibo==3)
                    {
                        $oct_firmado_empresa++;
                    }
                    if ($recibo->id_estado_recibo==3)
                    {
                        $oct_firmado_empleado++;
                    }

                break;
                case 11:
                    $nov++;
                    if ($recibo->id_estado_recibo==2 or $recibo->id_estado_recibo==3)
                    {
                        $nov_firmado_empresa++;
                    }
                    if ($recibo->id_estado_recibo==3)
                    {
                        $nov_firmado_empleado++;
                    }
                break;
                case 12:
                    $dic++;
                    if ($recibo->id_estado_recibo==2 or $recibo->id_estado_recibo==3)
                    {
                        $dic_firmado_empresa++;
                    }
                    if ($recibo->id_estado_recibo==3)
                    {
                        $dic_firmado_empleado++;
                    }
                break;
            }
        }
        //control de periodos creados
        $periodos = DB::table('periodos')->where('año',$id)->get();
        $existencia_ene=0;$existencia_feb=0;$existencia_mar=0;
        $existencia_abr=0;$existencia_may=0;$existencia_jun=0;
        $existencia_jul=0;$existencia_ago=0;$existencia_set=0;
        $existencia_oct=0;$existencia_nov=0;$existencia_dic=0;
        foreach ($periodos as $periodo)
        {
            switch ($periodo->mes)
            {
                case 1:
                $existencia_ene=1;
                    break;
                case 2:
                $existencia_feb=1;
                    break;
                case 3:
                $existencia_mar=1;
                    break;
                case 4:
                $existencia_abr=1;
                    break;
                case 5:
                $existencia_may=1;
                    break;
                case 6:
                $existencia_jun=1;
                    break;
                case 7:
                $existencia_jul=1;
                    break;
                case 8:
                $existencia_ago=1;
                    break;
                case 9:
                $existencia_set=1;
                    break;
                case 10:
                $existencia_oct=1;
                    break;
                case 11:
                $existencia_nov=1;
                    break;
                case 12:
                $existencia_dic=1;
                    break;
            }
        }
        $año=$id;
        $fecha_hora = date('d/m/Y H:i');
        $user = DB::table('users')
        ->join('personas','personas.id_usuario','=','users.id')
        ->where('users.id',Auth::user()->id)
        ->first();

        $pdf = PDF::loadView('rrhh.informe_pdf',[
        'user'=>$user,
        'fecha_hora'=>$fecha_hora,
        'año'=>$año,
        'cantidad_empleados'=>$cantidad_empleados,
        'ene'=>$ene,
        'ene_firmado_empresa'=>$ene_firmado_empresa,
        'ene_firmado_empleado'=>$ene_firmado_empleado,
        'existencia_ene'=>$existencia_ene,
        'feb'=>$feb,
        'feb_firmado_empresa'=>$feb_firmado_empresa,
        'feb_firmado_empleado'=>$feb_firmado_empleado,
        'existencia_feb'=>$existencia_feb,
        'mar'=>$mar,
        'mar_firmado_empresa'=>$mar_firmado_empresa,
        'mar_firmado_empleado'=>$mar_firmado_empleado,
        'existencia_mar'=>$existencia_mar,
        'abr'=>$abr,
        'abr_firmado_empresa'=>$abr_firmado_empresa,
        'abr_firmado_empleado'=>$abr_firmado_empleado,
        'existencia_abr'=>$existencia_abr,
        'may'=>$may,
        'may_firmado_empresa'=>$may_firmado_empresa,
        'may_firmado_empleado'=>$may_firmado_empleado,
        'existencia_may'=>$existencia_may,
        'jun'=>$jun,
        'jun_firmado_empresa'=>$jun_firmado_empresa,
        'jun_firmado_empleado'=>$jun_firmado_empleado,
        'existencia_jun'=>$existencia_jun,
        'jul'=>$jul,
        'jul_firmado_empresa'=>$jul_firmado_empresa,
        'jul_firmado_empleado'=>$jul_firmado_empleado,
        'existencia_jul'=>$existencia_jul,
        'ago'=>$ago,
        'ago_firmado_empresa'=>$ago_firmado_empresa,
        'ago_firmado_empleado'=>$ago_firmado_empleado,
        'existencia_ago'=>$existencia_ago,
        'set'=>$set,
        'set_firmado_empresa'=>$set_firmado_empresa,
        'set_firmado_empleado'=>$set_firmado_empleado,
        'existencia_set'=>$existencia_set,
        'oct'=>$oct,
        'oct_firmado_empresa'=>$oct_firmado_empresa,
        'oct_firmado_empleado'=>$oct_firmado_empleado,
        'existencia_oct'=>$existencia_oct,
        'nov'=>$nov,
        'nov_firmado_empresa'=>$nov_firmado_empresa,
        'nov_firmado_empleado'=>$nov_firmado_empleado,
        'existencia_nov'=>$existencia_nov,
        'dic'=>$dic,
        'dic_firmado_empresa'=>$dic_firmado_empresa,
        'dic_firmado_empleado'=>$dic_firmado_empleado,
        'existencia_dic'=>$existencia_dic
        ]);

        return $pdf->download();
    }
    public function getCrearNuevoPeriodo()
    {
        $periodos = DB::table('periodos')->select('mes','año','estado_periodo')->paginate(11);

        if ($periodos->count()==0)
        {
            return view('rrhh.crear_nuevo_periodo')->with('periodos',$periodos)->with('error','No existen periodos creados');
        }else
        {
            return view('rrhh.crear_nuevo_periodo')->with('periodos',$periodos);
        }
    }
    public function getCrear(ValidacionPeriodo $request)
    {

        //controla si el periodo que se intenta crear existe, si existe devolver un mensajes de error y sino crea el mismo

        $periodos=DB::table('periodos') ->where('año',$request->año)
        ->where('mes',$request->mes)->paginate(11);

        if ($periodos->count()==0)
        {
            $estructura_carpetas_nuevos                     = 'C:/xampp/htdocs/sgfrs/public/recibos/nuevos/' . $request->año . '/' . $request->mes;
            $estructura_carpetas_pendientes                 = 'C:/xampp/htdocs/sgfrs/public/recibos/pendientes/' . $request->año . '/' . $request->mes;
            $estructura_carpetas_firmados_empresa           = 'C:/xampp/htdocs/sgfrs/public/recibos/firmados_empresa/' . $request->año . '/' . $request->mes;
            $estructura_carpetas_firmados_empresa_empleados = 'C:/xampp/htdocs/sgfrs/public/recibos/firmados_empresa_empleados/' . $request->año . '/' . $request->mes;
            $estructura_carpetas_recibos_corregidos = 'C:/xampp/htdocs/sgfrs/public/recibos/recibos_corregidos/' . $request->año . '/' . $request->mes;
            if (file_exists( $estructura_carpetas_nuevos))
            {
                $periodos = DB::table('periodos')->paginate(6);
                return view('rrhh.crear_nuevo_periodo')->with('error','Ya existen carpetas de recibos en el sistema, favor verifique el directorio')->with('periodos',$periodos);
            }else
            {
                if (file_exists($estructura_carpetas_pendientes))
                {
                    $periodos = DB::table('periodos')->paginate(6);
                    return view('rrhh.crear_nuevo_periodo')->with('error','Ya existen carpetas de recibos en el sistema, favor verifique el directorio')->with('periodos',$periodos);
                }else
                {
                    if (file_exists($estructura_carpetas_firmados_empresa))
                    {
                        $periodos = DB::table('periodos')->paginate(6);
                        return view('rrhh.crear_nuevo_periodo')->with('error','Ya existen carpetas de recibos en el sistema, favor verifique el directorio')->with('periodos',$periodos);
                    }else
                    {
                        if (file_exists($estructura_carpetas_firmados_empresa_empleados))
                        {
                            $periodos = DB::table('periodos')->paginate(6);
                            return view('rrhh.crear_nuevo_periodo')->with('error','Ya existen carpetas de recibos en el sistema, favor verifique el directorio')->with('periodos',$periodos);
                        }else
                        {
                            if (file_exists($estructura_carpetas_recibos_corregidos))
                            {
                                $periodos = DB::table('periodos')->paginate(6);
                                return view('rrhh.crear_nuevo_periodo')->with('error','Ya existen carpetas de recibos en el sistema, favor verifique el directorio')->with('periodos',$periodos);
                            }else
                            {
                                mkdir($estructura_carpetas_nuevos, 0777, true);
                                mkdir($estructura_carpetas_pendientes, 0777, true);
                                mkdir($estructura_carpetas_firmados_empresa, 0777, true);
                                mkdir($estructura_carpetas_firmados_empresa_empleados, 0777, true);
                                mkdir($estructura_carpetas_recibos_corregidos, 0777, true);
                                $periodo = new Periodo();
                                $periodo->estado_periodo = 0;
                                $periodo->mes          =  $request->mes;
                                $periodo->año          = $request->año;
                                $periodo->save();

                                //inicio codigo auditoria
                                $auditoria = new Auditoria();
                                $auditoria->fecha_hora = date('Y-m-d H:i:s');
                                $auditoria->cedula = session()->get('cedula_usuario');
                                $auditoria->rol = session()->get('rol_usuario');
                                $auditoria->ip = session()->get('ip_usuario');
                                $auditoria->operacion = "Creación de nuevo periodo";
                                $auditoria->descripcion = "Se procedio a la creación del periodo ". $request->mes . '/' . $request->año;
                                $auditoria->save();
                                //fin codigo auditoria
                                $periodos = DB::table('periodos')->select('mes','año','estado_periodo')->paginate(11);

                                //esta funcion controla si existen empleados sin recibos para actualizarlos en la BD
                                $funcion = (new FuncionesControlador)->ControlEmpleadosSinRecibos();

                                return view('rrhh.crear_nuevo_periodo')->with('msj','Periodo creado correctamente! Mes: '.$request->mes.'  -   Año: '.$request->año)->with('periodos',$periodos)->with('boton','boton');
                            }
                        }
                    }
                }
            }
        }else
        {
            $periodos = DB::table('periodos')->paginate(6);
            return view('rrhh.crear_nuevo_periodo')->with('error','Este mes y año de periodo ya existen. Mes: '.$request->mes.'  -   Año: '.$request->año)->with('periodos',$periodos)->with('boton','boton');
        }
    }
    public function getValidarRecibos()
    {

        return view('rrhh.validar_recibos');
    }
    public function postValidarRecibos(ValidacionPeriodo $request)
    {
        $consulta = DB::table('periodos')->where('mes',$request->mes)->where('año',$request->año)->where('estado_periodo','0')->get();

        if ($consulta=='[]')
        {
            return view('rrhh.validar_recibos')->with('error','No existe este periodo o ya se encuentra cerrado. Periodo Mes: '.$request->mes.'  -  Año: '.$request->año);
        } else {
            $mes= $request->mes; //se obtiene el mes del periodo a validar
            $año= $request->año; //se obtiene el año del periodo a validar
            $cantidad_empleados = DB::table('personas')->where('id_rol', '1')->orWhere('id_rol', '2')->orWhere('id_rol', '4')->orWhere('id_rol', '5')->count();
            //se obtiene la cantidad de usuarios que son empleados
            $dir= "C:/xampp/htdocs/sgfrs/public/recibos/nuevos/" . $año . "/" . $mes . "/"; //se define la direccion del directorio que sera validado
            $a= 0;$b= 0;$c= 0;$d= 0;$e= 0; //contadores de datos


            if (count(scandir($dir))==2)//busca si hay archivos en el directorio, no se cuenta . ni .. que viene por defecto
            {
                return view('rrhh.validar_recibos')->with('error','No se encontraron recibos para validar, verifique que fueron cargados en la carpeta de nuevos recibos correspondientes al periodo seleccionado
                    ');
            }

            foreach (scandir($dir) as $f) //esta funcion permite leer el nombre de los archivos contenidos segun directorio especificado y los guarda en la variable $f por cada pasada de la iteraccion hasta leer todos los archivos del directorio
            {
                if ($f !== '.' and $f !== '..') // se descarta los elementos "." y ".." ya que no son archivos
                {
                    $e++; //contador de cantidad de archivos procesados
                    if (strtolower(substr($f, -4)) == '.pdf') //se controlar si la extension del archivo es .pdf
                    {
                        if (substr($f, -9, 3) == "-".$mes )
                            //and substr($f, -6, 2) == substr($año, -2))
                        //se verifica si el mes y año corresponde con el que se quiere validar
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
            if ($a > 0) //aqui se guardan la cantidad empleados en el sistema que no tienen recibos creados
            {
                $recibos_correctos = count($recibos);
                $resultado[4]      = $cantidad_empleados - $recibos_correctos;
            } else {
                $resultado[4] = 0;
            }

            $resultado[5] = $e; //aqui se guardan la cantidad de archivos que fueron procesados
            return view('rrhh.validar_recibos')->with('msj','Se procedio correctamente con la validación del periodo seleccionado. Mes: '.$request->mes.'  -  Año: '.$request->año)->with('resultados', $resultado)->with('mes',$request->mes)->with('año',$request->año); //se envia los resultados de la validacion a la vista
        }
    }
    public function getImportarRecibos()
    {

        return view('rrhh.importar_recibos');
    }
    public function getRecibosImportados(ValidacionPeriodo $request)
    {
        $consulta = DB::table('periodos')->where('mes',$request->mes)->where('año',$request->año)->where('estado_periodo','0')->get();
        foreach ($consulta as $result)
        {
            $id_periodo= $result->id_periodo;
        }

        if ($consulta=='[]')
        {
            return view('rrhh.importar_recibos')->with('error','No existe este periodo o ya se encuentra cerrado. Periodo Mes: '.$request->mes.'  -  Año: '.$request->año);
        } else {
            $mes= $request->mes; //se obtiene el mes del periodo a validar
            $año= $request->año; //se obtiene el año del periodo a validar
            $cantidad_empleados = DB::table('personas')->where('id_rol', '1')->orWhere('id_rol', '2')->orWhere('id_rol', '4')->orWhere('id_rol', '5')->count();//se obtiene la cantidad de usuarios que son empleados
            $dir= "C:/xampp/htdocs/sgfrs/public/recibos/nuevos/" . $año . "/" . $mes . "/"; //se define la direccion del directorio que sera validado
            $a= 0;$b= 0;$c= 0;$d= 0;$e = 0; //contadores de datos

            if (count(scandir($dir))==2)//busca si hay archivos en el directorio, no se cuenta . ni .. que viene por defecto
            {
                return view('rrhh.importar_recibos')->with('error','No se encontraron recibos para importar, verifique que fueron cargados en la carpeta de nuevos recibos correspondientes al periodo seleccionado, periodo -> mes: '.$mes.', año: '.$año);
            }
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
                                $Recibo= new Recibo();
                                $Recibo->id_recibo= substr($f, 0, -4);
                                $Recibo->id_estado_recibo = 1;
                                $Recibo->cedula= $cedula;
                                $Recibo->id_periodo= $id_periodo;
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
                //inicio codigo auditoria
                $auditoria = new Auditoria();
                $auditoria->fecha_hora = date('Y-m-d H:i:s');
                $auditoria->cedula = session()->get('cedula_usuario');
                $auditoria->rol = session()->get('rol_usuario');
                $auditoria->ip = session()->get('ip_usuario');
                $auditoria->operacion = "Importación de recibos";
                $auditoria->descripcion = "Se procedio a la importación de recibos del periodo ". $mes . '/' . $año;
                $auditoria->save();
                //fin codigo auditoria

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

                //esta funcion controla si existen empleados sin recibos para actualizarlos en la BD
                $funcion = (new FuncionesControlador)->ControlEmpleadosSinRecibos();

                //esta funcion envia las notificaciones

                 $health = Ping::check('www.google.com.py');

                            if($health == 200) {
                                $notificacion = (new NotificaciónControlador)->NotifyEmpleador();
                                $msjmail='Se notificó al empleador que existe recibos a firmar';
                            } else {
                                $msjmail='No se pudo notificar al empleador por problemas de internet';
                            }   

                  return view('rrhh.importar_recibos')->with('msj','Se procedio correctamente con la importación del periodo seleccionado. Mes: '.$request->mes.'  -  Año: '.$request->año)->with('resultados', $resultado)->with('mes',$request->mes)->with('año',$request->año)->with('msjmail',$msjmail); //se envia los resultados de la validacion a la vista
            }
    }
    public function getEmpleadosSinRecibos()
    {
        //esta funcion controla si se cierran los periodos
        $resultado = (new FuncionesControlador)->getControlPeriodos();

        $periodos = DB::table('periodos')
        ->where('periodos.estado_periodo', 0)
        ->paginate(8);

        if ($periodos->count()==0)
        {
            return view('rrhh.empleados_sin_recibos')->with('periodos',$periodos)->with('msj','No existen periodos con recibos pendientes!');
        }else
        {
             return view('rrhh.empleados_sin_recibos')->with('periodos',$periodos)->with('boton','boton');
        }
    }
    public function getExcel()
    {

        return (new EmpleadosSinRecibosExport)->download('InformeExcel-'.date('dmY-Hi').'.xlsx');
    }
    public function getVerEmpleadosSinRecibos($id)
    {
        $datos = DB::table('empleados_sin_recibos')
        ->join('personas','empleados_sin_recibos.cedula','=','personas.cedula')
        ->where('id_periodo',$id)
        ->paginate(12);

        $periodos = DB::table('periodos')
        ->where('id_periodo',$id)
        ->get();

        foreach ($periodos as $periodo)
        {
            $año = $periodo->año;
            $mes = $periodo->mes;
        }

        if ($datos->count()==0)
        {
            return view('rrhh.ver_empleados_sin_recibos')->with('msj','No existen empleados sin recibos para este periodo');
        }else
        {
            return view('rrhh.ver_empleados_sin_recibos')->with('datos',$datos)->with('boton','boton')->with('año',$año)->with('mes',$mes);
        }
    }
    public function getListaRecibos()
    {
        $recibos = DB::table('recibos')
        ->join('personas','personas.cedula','=','recibos.cedula')
        ->paginate(10);

        if ($recibos->count()==0)
        {
            return view('rrhh.lista_recibos')->with('error','No existe ningún recibo en el sistema');
        }
        else
        {
            return view('rrhh.lista_recibos')->with('recibos',$recibos);
        }
    }
    public function getVerReciboACorregir ($id)
    {
        $recibo = DB::table('recibos')
        ->where('id_recibo',$id)
        ->first();

        switch ($recibo->id_estado_recibo)
        {
            case '1':
                $url = "/recibos/pendientes/20".substr($id,-2,2)."/".substr($id,-4,2)."/".$id.".pdf";
                return view('rrhh.ver_recibo_a_corregir',compact('id'),compact('url'));
            break;
            case '2':
                $url = "/recibos/firmados_empresa/20".substr($id,-2,2)."/".substr($id,-4,2)."/".$id.".pdf";
                return view('rrhh.ver_recibo_a_corregir',compact('id'),compact('url'));
            break;
            case '3':
                $url = "/recibos/firmados_empresa_empleados/20".substr($id,-2,2)."/".substr($id,-4,2)."/".$id.".pdf";
                return view('rrhh.ver_recibo_a_corregir',compact('id'),compact('url'));
            break;
        }
    }
    public function postCorregirRecibo(Request $request )
    {
        $consulta = DB::table('recibos')
        ->where('id_recibo',$request->id)
        ->get();

        foreach ($consulta as $dato)
        {
            $var = $dato->id_estado_recibo;
            $cedula = $dato->cedula;
        }

        $id_nuevo = $request->id.'-'.date('dmY-His');

        $nuevo_nombre_recibo = $id_nuevo.'.pdf';

        $recibo = $request->id.'.pdf';

        try
        {
            switch ($var)
            {
                case 1:
                     rename("C:/xampp/htdocs/sgfrs/public/recibos/pendientes/20".substr($request->id,-2,2)."/".substr($request->id,-4,2)."/".$recibo,
                     "C:/xampp/htdocs/sgfrs/public/recibos/recibos_corregidos/20".substr($request->id,-2,2)."/".substr($request->id,-4,2)."/".$nuevo_nombre_recibo);
                    break;
                case 2:
                    rename("C:/xampp/htdocs/sgfrs/public/recibos/firmados_empresa/20".substr($request->id,-2,2)."/".substr($request->id,-4,2)."/".$recibo, "C:/xampp/htdocs/sgfrs/public/recibos/recibos_corregidos/20".substr($request->id,-2,2)."/".substr($request->id,-4,2)."/".$nuevo_nombre_recibo);
                    break;
                case 3:
                    rename("C:/xampp/htdocs/sgfrs/public/recibos/firmados_empresa_empleados/20".substr($request->id,-2,2)."/".substr($request->id,-4,2)."/".$recibo, "C:/xampp/htdocs/sgfrs/public/recibos/recibos_corregidos/20".substr($request->id,-2,2)."/".substr($request->id,-4,2)."/".$nuevo_nombre_recibo);
                    break;
            }

            $recibo_corregido = new Recibo_con_error();
            $recibo_corregido->id = $id_nuevo;
            $recibo_corregido->id_recibo = $request->id;
            $recibo_corregido->cedula = $cedula;
            $recibo_corregido->motivo_error = $request->motivo;
            $recibo_corregido->fecha_hora = date('Y-m-d H:i:s');
            $recibo_corregido->save();

            DB::table('recibos')
            ->where('id_recibo',$request->id)
            ->delete();

            //esta funcion controla si existen empleados sin recibos para actualizarlos en la BD
            $funcion = (new FuncionesControlador)->ControlEmpleadosSinRecibos();

            //inicio codigo auditoria
            $auditoria = new Auditoria();
            $auditoria->fecha_hora = date('Y-m-d H:i:s');
            $auditoria->cedula = session()->get('cedula_usuario');
            $auditoria->rol = session()->get('rol_usuario');
            $auditoria->ip = session()->get('ip_usuario');
            $auditoria->operacion = "Correción de recibo";
            $auditoria->descripcion = "Se procedio a la correción de un recibo del sistema con el siguiente ID: ".$request->id;
            $auditoria->save();
            //fin codigo auditoria

            $recibos = DB::table('recibos')
            ->join('personas','personas.cedula','=','recibos.cedula')
            ->paginate(10);

            if ($recibos->count()==0)
            {
                return view('rrhh.lista_recibos')->with('msj','El recibo fue corregido, favor importe un nuevo recibo con el mismo ID: '.$request->id);
            }
            else
            {
                return view('rrhh.lista_recibos')->with('recibos',$recibos)->with('msj','El recibo fue corregido, favor importe un nuevo recibo con el mismo ID: '.$request->id);
            }

        } catch (Exception $e)
        {
            //esta funcion controla si existen empleados sin recibos para actualizarlos en la BD
            $funcion = (new FuncionesControlador)->ControlEmpleadosSinRecibos();

            $recibos = DB::table('recibos')
            ->join('personas','personas.cedula','=','recibos.cedula')
            ->paginate(10);

            if ($recibos->count()==0)
            {
                return view('rrhh.lista_recibos')->with('error','Ocurrio un error: '.$e);
            }
            else
            {
                return view('rrhh.lista_recibos')->with('recibos',$recibos)>with('error','Ocurrio un error: '.$e);
            }
        }
    }
    public function getVerHistorial()
    {
        $recibos = DB::table('recibos_con_errores')
        ->join('personas','personas.cedula','=','recibos_con_errores.cedula')
        ->paginate(10);

        //dd($recibos);
        if ($recibos->count()==0)
        {
            return view("rrhh.historial_recibos_corregidos")->with('error','No existen recibos corregidos');
        }else
        {
            return view("rrhh.historial_recibos_corregidos")->with('recibos',$recibos);
        }
    }
    public function getVerReciboCorregido($id)
    {

        $recibo = DB::table('recibos_con_errores')
        ->where('id',$id)
        ->first();
        $url = "/recibos/recibos_corregidos/20".substr($recibo->id_recibo,-2,2)."/".substr($recibo->id_recibo,-4,2)."/".$id.".pdf";
        return view('rrhh.ver_recibo_corregido',compact('url'));
    }
    public function getPendientesFirmaEmpresa()
    {
        $recibos = DB::table('recibos')
        ->join('personas', 'recibos.cedula','=','personas.cedula')
        ->where('recibos.id_estado_recibo', '1')
        ->paginate(8);
        if ($recibos->count()==0)
        {
            return view('rrhh.pendientes_firma_empresa')->with('recibos',$recibos)->with('msj','No existen recibos pendientes de firma por la empresa!');
        }else
        {
             return view('rrhh.pendientes_firma_empresa')->with('recibos',$recibos)->with('boton','boton');
        }
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
        ->where('recibos.id_estado_recibo', '2')
        ->paginate(8);
        if ($recibos->count()==0)
        {
        return view('rrhh.pendientes_firma_empleados')->with('recibos',$recibos)->with('msj','No existen recibos pendientes de firma por la empresa!');
        }else
        {
         return view('rrhh.pendientes_firma_empleados')->with('recibos',$recibos)->with('boton','boton');
        }
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
        ->where('recibos.id_estado_recibo', '3')
        ->paginate(8);
        if ($recibos->count()==0)
        {
            return view('rrhh.firmados_empresa_empleados')->with('recibos',$recibos)->with('msj','No existen recibos firmados por la empresa y empleados!');
        }else
        {
             return view('rrhh.firmados_empresa_empleados')->with('recibos',$recibos)->with('boton','boton');
        }
    }
    public function getVerReciboFirmadoEmpresaEmpleado($id)
    {
        $id="/recibos/firmados_empresa_empleados/"."20".substr($id, -2, 2)."/".substr($id, -4, 2)."/".$id.".pdf";
        return view('rrhh.ver_recibo_firmado_empresa_empleado')->with('id',$id);
    }
    public function getTodosLosRecibos()
    {
        $recibos = DB::table('recibos')
        ->join('personas', 'recibos.cedula','=','personas.cedula')
        ->where('recibos.id_estado_recibo', '1')
        ->orWhere('recibos.id_estado_recibo', '2')
        ->orWhere('recibos.id_estado_recibo', '3')
        ->paginate(8);
        if ($recibos->count()==0)
        {
            return view('rrhh.todos_los_recibos')->with('recibos',$recibos)->with('msj','No existen recibos firmados por la empresa y empleados!');
        }else
        {
             return view('rrhh.todos_los_recibos')->with('recibos',$recibos)->with('boton','boton');
        }
    }
    public function getVerTodosLosRecibos($id)
    {
        $consulta = DB::table('recibos')
        ->where('id_recibo',$id)
        ->first();
        switch ($consulta->id_estado_recibo)
        {
            case 1:
                $id="/recibos/pendientes/"."20".substr($id, -2, 2)."/".substr($id, -4, 2)."/".$id.".pdf";
                return view('rrhh.ver_todos_los_recibos')->with('id',$id);
            break;
            case 2:
                $id="/recibos/firmados_empresa/"."20".substr($id, -2, 2)."/".substr($id, -4, 2)."/".$id.".pdf";
                return view('rrhh.ver_todos_los_recibos')->with('id',$id);
            break;
            case 3:
                $id="/recibos/firmados_empresa_empleados/"."20".substr($id, -2, 2)."/".substr($id, -4, 2)."/".$id.".pdf";
                return view('rrhh.ver_todos_los_recibos')->with('id',$id);
            break;
        }
    }
    public function getInformesRrhh()
    {
        //esta funcion controla si se cierran los periodos
        $resultado = (new FuncionesControlador)->getControlPeriodos();

        $años = DB::table('periodos')
        ->select('año')
        ->groupBy('año')
        ->orderBy('año','desc')
        ->get();
        if ($años=='[]')
        {
            return view('rrhh.informes_rrhh')->with('años',$años)->with('msj','No existen periodos creados!');
        }else
        {
            return view('rrhh.informes_rrhh')->with('años',$años)->with('boton','boton');
        }
    }
    public function postVerInformesRrhh(Request $request)
    {
           $recibos = DB::table('recibos')
               ->join('periodos', 'recibos.id_periodo','=','periodos.id_periodo')
               ->where('periodos.año',$request->año)
               ->get();
            $cantidad_empleados = DB::table('personas')->where('id_rol', '1')->orWhere('id_rol', '2')->orWhere('id_rol', '4')->orWhere('id_rol', '5')->count();

            $ene=0; $feb=0; $mar=0; $abr=0; $may=0; $jun=0;
            $jul=0; $ago=0; $set=0; $oct=0; $nov=0; $dic=0;
            $ene_firmado_empresa=0;$feb_firmado_empresa=0;
            $mar_firmado_empresa=0;$abr_firmado_empresa=0;
            $may_firmado_empresa=0;$jun_firmado_empresa=0;
            $jul_firmado_empresa=0;$ago_firmado_empresa=0;
            $set_firmado_empresa=0;$oct_firmado_empresa=0;
            $nov_firmado_empresa=0;$dic_firmado_empresa=0;
            $ene_firmado_empleado=0;$feb_firmado_empleado=0;
            $mar_firmado_empleado=0;$abr_firmado_empleado=0;
            $may_firmado_empleado=0;$jun_firmado_empleado=0;
            $jul_firmado_empleado=0;$ago_firmado_empleado=0;
            $set_firmado_empleado=0;$oct_firmado_empleado=0;
            $nov_firmado_empleado=0;$dic_firmado_empleado=0;
            foreach ($recibos as $recibo)
            {
                switch ($recibo->mes)
                {
                    case 1:
                        $ene++;
                        if ($recibo->id_estado_recibo==2 or $recibo->id_estado_recibo==3)
                        {
                            $ene_firmado_empresa++;
                        }
                        if ($recibo->id_estado_recibo==3)
                        {
                            $ene_firmado_empleado++;
                        }
                    break;
                    case 2:
                        $feb++;
                        if ($recibo->id_estado_recibo==2 or $recibo->id_estado_recibo==3)
                        {
                            $feb_firmado_empresa++;
                        }
                        if ($recibo->id_estado_recibo==3)
                        {
                            $feb_firmado_empleado++;
                        }
                    break;
                    case 3:
                        $mar++;
                        if ($recibo->id_estado_recibo==2 or $recibo->id_estado_recibo==3)
                        {
                            $mar_firmado_empresa++;
                        }
                        if ($recibo->id_estado_recibo==3)
                        {
                            $mar_firmado_empleado++;
                        }
                    break;
                    case 4:
                        $abr++;
                        if ($recibo->id_estado_recibo==2 or $recibo->id_estado_recibo==3)
                        {
                            $abr_firmado_empresa++;
                        }
                        if ($recibo->id_estado_recibo==3)
                        {
                            $abr_firmado_empleado++;
                        }
                    break;
                    case 5:
                        $may++;
                        if ($recibo->id_estado_recibo==2 or $recibo->id_estado_recibo==3)
                        {
                            $may_firmado_empresa++;
                        }
                        if ($recibo->id_estado_recibo==3)
                        {
                            $may_firmado_empleado++;
                        }
                    break;
                    case 6:
                        $jun++;
                        if ($recibo->id_estado_recibo==2 or $recibo->id_estado_recibo==3)
                        {
                            $jun_firmado_empresa++;
                        }
                        if ($recibo->id_estado_recibo==3)
                        {
                            $jun_firmado_empleado++;
                        }
                    break;
                    case 7:
                        $jul++;
                        if ($recibo->id_estado_recibo==2 or $recibo->id_estado_recibo==3)
                        {
                            $jul_firmado_empresa++;
                        }
                        if ($recibo->id_estado_recibo==3)
                        {
                            $jul_firmado_empleado++;
                        }
                    break;
                    case 8:
                        $ago++;
                        if ($recibo->id_estado_recibo==2 or $recibo->id_estado_recibo==3)
                        {
                            $ago_firmado_empresa++;
                        }
                        if ($recibo->id_estado_recibo==3)
                        {
                            $ago_firmado_empleado++;
                        }
                    break;
                    case 9:
                        $set++;
                        if ($recibo->id_estado_recibo==2 or $recibo->id_estado_recibo==3)
                        {
                            $set_firmado_empresa++;
                        }
                        if ($recibo->id_estado_recibo==3)
                        {
                            $set_firmado_empleado++;
                        }
                    break;
                    case 10:
                        $oct++;
                        if ($recibo->id_estado_recibo==2 or $recibo->id_estado_recibo==3)
                        {
                            $oct_firmado_empresa++;
                        }
                        if ($recibo->id_estado_recibo==3)
                        {
                            $oct_firmado_empleado++;
                        }

                    break;
                    case 11:
                        $nov++;
                        if ($recibo->id_estado_recibo==2 or $recibo->id_estado_recibo==3)
                        {
                            $nov_firmado_empresa++;
                        }
                        if ($recibo->id_estado_recibo==3)
                        {
                            $nov_firmado_empleado++;
                        }
                    break;
                    case 12:
                        $dic++;
                        if ($recibo->id_estado_recibo==2 or $recibo->id_estado_recibo==3)
                        {
                            $dic_firmado_empresa++;
                        }
                        if ($recibo->id_estado_recibo==3)
                        {
                            $dic_firmado_empleado++;
                        }
                    break;
                }
            }
            //control de periodos creados
            $periodos = DB::table('periodos')->where('año',$request->año)->get();
            $existencia_ene=0;$existencia_feb=0;$existencia_mar=0;
            $existencia_abr=0;$existencia_may=0;$existencia_jun=0;
            $existencia_jul=0;$existencia_ago=0;$existencia_set=0;
            $existencia_oct=0;$existencia_nov=0;$existencia_dic=0;
            foreach ($periodos as $periodo)
            {
                switch ($periodo->mes)
                {
                    case 1:
                    $existencia_ene=1;
                        break;
                    case 2:
                    $existencia_feb=1;
                        break;
                    case 3:
                    $existencia_mar=1;
                        break;
                    case 4:
                    $existencia_abr=1;
                        break;
                    case 5:
                    $existencia_may=1;
                        break;
                    case 6:
                    $existencia_jun=1;
                        break;
                    case 7:
                    $existencia_jul=1;
                        break;
                    case 8:
                    $existencia_ago=1;
                        break;
                    case 9:
                    $existencia_set=1;
                        break;
                    case 10:
                    $existencia_oct=1;
                        break;
                    case 11:
                    $existencia_nov=1;
                        break;
                    case 12:
                    $existencia_dic=1;
                        break;
                }
            }
            return view('rrhh.resultado_informes_rrhh')
            ->with('año',$request->año)->with('cantidad_empleados',$cantidad_empleados)

            ->with('ene',$ene)
            ->with('ene_firmado_empresa',$ene_firmado_empresa)
            ->with('ene_firmado_empleado',$ene_firmado_empleado)
            ->with('existencia_ene',$existencia_ene)

            ->with('feb',$feb)
            ->with('feb_firmado_empresa',$feb_firmado_empresa)
            ->with('feb_firmado_empleado',$feb_firmado_empleado)
            ->with('existencia_feb',$existencia_feb)

            ->with('mar',$mar)
            ->with('mar_firmado_empresa',$mar_firmado_empresa)
            ->with('mar_firmado_empleado',$mar_firmado_empleado)
            ->with('existencia_mar',$existencia_mar)

            ->with('abr',$abr)
            ->with('abr_firmado_empresa',$abr_firmado_empresa)
            ->with('abr_firmado_empleado',$abr_firmado_empleado)
            ->with('existencia_abr',$existencia_abr)

            ->with('may',$may)
            ->with('may_firmado_empresa',$may_firmado_empresa)
            ->with('may_firmado_empleado',$may_firmado_empleado)
            ->with('existencia_may',$existencia_may)

            ->with('jun',$jun)
            ->with('jun_firmado_empresa',$jun_firmado_empresa)
            ->with('jun_firmado_empleado',$jun_firmado_empleado)
            ->with('existencia_jun',$existencia_jun)

            ->with('jul',$jul)
            ->with('jul_firmado_empresa',$jul_firmado_empresa)
            ->with('jul_firmado_empleado',$jul_firmado_empleado)
            ->with('existencia_jul',$existencia_jul)

            ->with('ago',$ago)
            ->with('ago_firmado_empresa',$ago_firmado_empresa)
            ->with('ago_firmado_empleado',$ago_firmado_empleado)
            ->with('existencia_ago',$existencia_ago)

            ->with('set',$set)
            ->with('set_firmado_empresa',$set_firmado_empresa)
            ->with('set_firmado_empleado',$set_firmado_empleado)
            ->with('existencia_set',$existencia_set)

            ->with('oct',$oct)
            ->with('oct_firmado_empresa',$oct_firmado_empresa)
            ->with('oct_firmado_empleado',$oct_firmado_empleado)
            ->with('existencia_oct',$existencia_oct)

            ->with('nov',$nov)
            ->with('nov_firmado_empresa',$nov_firmado_empresa)
            ->with('nov_firmado_empleado',$nov_firmado_empleado)
            ->with('existencia_nov',$existencia_nov)

            ->with('dic',$dic)
            ->with('dic_firmado_empresa',$dic_firmado_empresa)
            ->with('dic_firmado_empleado',$dic_firmado_empleado)
            ->with('existencia_dic',$existencia_dic)
            ;
    }
    public function getCambiarContraseña()
    {

        return view('rrhh.cambiar_contraseña');
    }
    public function postUpdatePassword(Request $request)
    {
        $rules = [
            'mypassword' => 'required',
            'password' => 'required|confirmed|min:4|max:18',
        ];

        $messages = [
            'mypassword.required' => 'El campo es requerido',
            'password.required' => 'El campo es requerido',
            'password.confirmed' => 'Los passwords no coinciden',
            'password.min' => 'El mínimo permitido son 6 caracteres',
            'password.max' => 'El máximo permitido son 18 caracteres',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails())
        {
            return redirect('empleado/cambiar_contraseña')->withErrors($validator);
        }
        else
        {
            if (Hash::check($request->mypassword, Auth::user()->password)){
                $user = new User;
                $user->where('email', '=', Auth::user()->email)
                     ->update(['password' => bcrypt($request->password)]);

                //inicio codigo auditoria
                    $auditoria = new Auditoria();
                    $auditoria->fecha_hora = date('Y-m-d H:i:s');
                    $auditoria->cedula = session()->get('cedula_usuario');
                    $auditoria->rol = session()->get('rol_usuario');
                    $auditoria->ip = session()->get('ip_usuario');
                    $auditoria->operacion = "Cambio de contraseña";
                    $auditoria->descripcion = "El usuario procedio al cambio de su contraseña de acceso al sistema";
                    $auditoria->save();
                //fin codigo auditoria

                return view('empleado/cambiar_contraseña')->with('msj', 'Se ha actualizado la contraseña con éxito!!');
            }
            else
            {
                return view('empleado/cambiar_contraseña')->with('error', 'La contraseña actual ingresada es incorrecta');
            }
        }
    }
}
