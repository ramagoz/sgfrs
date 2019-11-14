<?php
namespace App\Http\Controllers;
use App\Auditoria;
use App\Grupo_recibo;
use App\Http\Controllers\FuncionesControlador;
use App\Http\Requests\ValidacionCargaUsuario;
use App\Http\Requests;
use App\Periodo;
use App\Persona;
use App\Recibo;
use App\User;
use Auth;
use DB;
use DataTables;
use Illuminate\Auth\validate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Validator;

class EmpresaControlador extends Controller
{
    //Se obtienen datos para el datatable de ABM Oficial de Seguridad
    public function datatable()
    {
         $persona_rol= DB::table('personas')->where('id_rol', '5')->get();
         return Datatables::of($persona_rol)->make(true);
    }

    public function getIndexEmpresa()
    {
    	return view('empresa.inicio');
    }

    public function getBusquedaOficial()
    {
        return view('empresa.busqueda_oficial');
    }

    public function getAltaOficial()
    {
        return view('empresa.alta_oficial');
    }

    public function postOficialCargado(ValidacionCargaUsuario $request)
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
        $usuario = DB::table('users')->where('email', $request->correo)->get();
        foreach ($usuario as $users)
        {
            $id = $users->id;
        }
        $persona             = new Persona();
        $persona->id_usuario = $id;
        $persona->id_rol   = '5';//rol de oficial de seguridad
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
            $auditoria->operacion = "Alta de Oficial de Seguridad";
            $auditoria->descripcion = "Se procedio a la alta en el sistema del usuario con rol de Oficial de Seguridad con los siguientes datos:"."\n"
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
        return view('empresa.busqueda_oficial')->with('$msj','Se registro el usuario'.$request->nombre.' '.$request->apellido.' con CI Nro.'.$request->cedula);
    }

    public function getModificacionOficial(Request $request)
    {
    	$persona =DB::table('personas')->where('cedula',$request->cedula)->first();

        return view('empresa.modificacion_oficial', compact('persona'));

    }

    public function getOficialModificado(Request $request)
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
        //inicio codigo auditoria
            $auditoria = new Auditoria();
            $auditoria->fecha_hora = date('Y-m-d H:i:s');
            $auditoria->cedula = session()->get('cedula_usuario');
            $auditoria->rol = session()->get('rol_usuario');
            $auditoria->ip = session()->get('ip_usuario');
            $auditoria->operacion = "Actualización datos de Oficial de Seguridad";
            $auditoria->descripcion = "Se procedio a la actualización de datos en el sistema del usuario con rol de Oficial de Seguridad con los siguientes datos:"."\n"
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

       # return view('rrhh.empleado_cargado');
        return view('/empresa/busqueda_oficial')->with('msj','Los datos del usuario con CI Nro. '.$request->cedula.' se actualizaron correctamente!!!');

    }

    public function getRecibosPendientesEmpresa()
    {
        //esta funcion controla si se cierran los periodos
        $resultado = (new FuncionesControlador)->getControlPeriodos();

        $recibos = DB::table('recibos')
        ->join('personas', 'recibos.cedula','=','personas.cedula')
        ->where('recibos.id_estado_recibo', '1')
        ->paginate(7);
        if ($recibos->count() ==0)
        {
            return view('empresa.recibos_pendientes_empresa')->with('recibos',$recibos)->with('msj','No existen recibos pendientes de firma por la empresa!');
        }else
        {
            return view('empresa.recibos_pendientes_empresa')->with('recibos',$recibos)->with('boton','boton');
        }
    }

    public function getVerRecibo($id)
    {
        $id_recibo=$id;
        $id="/recibos/pendientes/"."20".substr($id, -2, 2)."/".substr($id, -4, 2)."/".$id.".pdf";
        return view('empresa.ver_recibo_pendiente_firma_empresa')->with('id',$id)->with('id_recibo',$id_recibo);
    }

    public function postFirmarReciboPendienteEmpresa(Request $request)
    {
        //Servicio de firma
        $datos = [
        'tipo_firma'=>1,
        'firmante'=>session()->get('cedula_usuario'),
        'estado_recibo'=>1,
        'id_recibo'=>$request->id,
        'pass'=>hash('sha256',$request->contraseña)];
        $id=$request->id;

        // Este es el webservice que vamos a consumir
        $wsdl = 'http://localhost:8080/WsDigitalSignature/services/ServicioFirma?wsdl';

        $parametros=array('encoding' => 'UTF-8','trace' => 1,"verify_peer"=>false);

        // Creamos el cliente SOAP que hará la solicitud

        $cliente = new \SoapClient($wsdl,$parametros);

        // Consumimos el servicio llamando al método que necesitamos, en este caso
        // func() es un método definido dentro del WSDL

        $resultado = $cliente->func($datos);
        //Se verifica si hay error durante el proceso de firma y se devuelve el error
        if ($resultado->funcReturn != "ok")// si el resultado es diferente de ok, ocurrio un error en el proceso de firma
        {
            $mes=substr($id, -4,2);
            $año=substr($id, -2,2);
            $id_recibo=$id;
            $id="/recibos/pendientes/20". $año . "/" . $mes."/".$id.".pdf";
            return view('empresa.ver_recibo_pendiente_firma_empresa')->with('id',$id)->with('id_recibo',$id_recibo)->with('error',$resultado->funcReturn);
        }
        //fin servicio firma

        $recibo =Recibo::find($id);
        $recibo->id_estado_recibo =2;
        $recibo->save();

        $mes=substr($id, -4,2);
        $año=substr($id, -2,2);

        //inicio codigo auditoria
        $auditoria = new Auditoria();
        $auditoria->fecha_hora = date('Y-m-d H:i:s');
        $auditoria->cedula = session()->get('cedula_usuario');
        $auditoria->rol = session()->get('rol_usuario');
        $auditoria->ip = session()->get('ip_usuario');
        $auditoria->operacion = "Firma de recibo";
        $auditoria->descripcion = "Se procedio a la firma del siguiente recibo: ".$id;
        $auditoria->save();
        //fin codigo auditoria

        $id="/recibos/firmados_empresa/20". $año . "/" . $mes."/".$id.".pdf";
        return view('empresa.ver_recibo_pendiente_firma_empleado')->with('id',$id)->with('msj','Recibo firmado correctamente!');
    }

    public function postFirmaMasivaRecibosPendientesEmpresa(Request $request)
    {
        //aqui se recuperan los identificadores de recibos que fueron selecionados para ser firmados, todos separados por ","
        $i=0;
        $CadenaRecibos='';
        if ($request->recibos_a_firmar <> '')
        {
            foreach ($request->recibos_a_firmar as $key => $value)
            {
                $i++;
                if ($i==1)
                {
                    $CadenaRecibos = $CadenaRecibos.$value;
                }else
                {
                    $CadenaRecibos = $CadenaRecibos.','.$value;
                }
            }
        }else
        {
            $recibos = DB::table('recibos')
            ->join('personas', 'recibos.cedula','=','personas.cedula')
            ->where('recibos.id_estado_recibo', '1')
            ->paginate(8);
            return view('empresa.recibos_pendientes_empresa')->with('recibos',$recibos)->with('error','No ha selecionado ningun recibo')->with('boton','boton');
        }

        //Servicio de firma
          $datos = [
          'tipo_firma'=>2,
          'firmante'=>session()->get('cedula_usuario'),
          'estado_recibo'=>1,
          'id_recibo'=>$CadenaRecibos,
          'pass'=>hash('sha256',$request->contraseña)];

          // Este es el webservice que vamos a consumir
          $wsdl = 'http://localhost:8080/WsDigitalSignature/services/ServicioFirma?wsdl';

          $parametros=array('encoding' => 'UTF-8','trace' => 1,"verify_peer"=>false);

          // Creamos el cliente SOAP que hará la solicitud

          $cliente = new \SoapClient($wsdl,$parametros);

          // Consumimos el servicio llamando al método que necesitamos, en este caso
          // func() es un método definido dentro del WSDL

          $resultado = $cliente->func($datos);
            //Se verifica si hay error durante el proceso de firma y se devuelve el error
            if ($resultado->funcReturn != "ok")// si el resultado es diferente de ok, ocurrio un error en el proceso de firma
            {
            $recibos = DB::table('recibos')
            ->join('personas', 'recibos.cedula','=','personas.cedula')
            ->where('recibos.id_estado_recibo', '1')
            ->paginate(8);
            return view('empresa.recibos_pendientes_empresa')->with('recibos',$recibos)->with('error',$resultado->funcReturn)->with('boton','boton');
            }
            //fin servicio firma
            //inicio codigo de autitoria
        foreach ($request->recibos_a_firmar as $key => $value)
        {
            $recibo =Recibo::find($value);
            $recibo->id_estado_recibo =2;
            $recibo->save();
            $mes=substr($value, -4,2);
            $año=substr($value, -2,2);

            $auditoria = new Auditoria();
            $auditoria->fecha_hora = date('Y-m-d H:i:s');
            $auditoria->cedula = session()->get('cedula_usuario');
            $auditoria->rol = session()->get('rol_usuario');
            $auditoria->ip = session()->get('ip_usuario');
            $auditoria->operacion = "Firma de recibo";
            $auditoria->descripcion = "Se procedio a la firma del siguiente recibo: ".$value;
            $auditoria->save();
            //fin codigo auditoria
        }
        $recibos = DB::table('recibos')
        ->join('personas', 'recibos.cedula','=','personas.cedula')
        ->where('recibos.id_estado_recibo', '2')
        ->paginate(8);

        return view('empresa.recibos_pendientes_empleados')->with('recibos',$recibos)->with('msj','Recibos firmados correctamente!')->with('boton','boton');
    }

    public function getRecibosPendientesEmpleados()
    {
        $recibos = DB::table('recibos')
        ->join('personas', 'recibos.cedula','=','personas.cedula')
        ->where('recibos.id_estado_recibo', '2')
        ->paginate(9);
        if ($recibos->count()==0)
        {
            return view('empresa.recibos_pendientes_empleados')->with('recibos',$recibos)->with('msj_error','No existen recibos pendientes de firma por los empleados!');
        }else
        {
            return view('empresa.recibos_pendientes_empleados')->with('recibos',$recibos)->with('boton','boton');
        }
    }

    public function getVerReciboPendienteFirmaEmpleado($id)
    {
        $id="/recibos/firmados_empresa/"."20".substr($id, -2, 2)."/".substr($id, -4, 2)."/".$id.".pdf";
        return view('empresa.ver_recibo_pendiente_firma_empleado')->with('id',$id);
    }

    public function getRecibosFirmadosEmpresaEmpleados()
    {
        $recibos = DB::table('recibos')
        ->join('personas', 'recibos.cedula','=','personas.cedula')
        ->where('recibos.id_estado_recibo', '3')
        ->paginate(9);
        if ($recibos->count()==0)
        {
            return view('empresa.recibos_firmados_empresa_empleados')->with('recibos',$recibos)->with('msj','No existen recibos firmados por la empresa y empleados!');
        }else
        {
            return view('empresa.recibos_firmados_empresa_empleados')->with('recibos',$recibos)->with('boton','boton');
        }
    }

    public function getVerReciboFirmadoEmpresaEmpleado($id)
    {
        $id="/recibos/firmados_empresa_empleados/"."20".substr($id, -2, 2)."/".substr($id, -4, 2)."/".$id.".pdf";
        return view('empresa.ver_recibo_firmado_empresa_empleado')->with('id',$id);
    }

    public function getInformesEmpresa()
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
            return view('empresa.informes_empresa')->with('años',$años)->with('msj','No existen periodos creados!');
        }else
        {
            return view('empresa.informes_empresa')->with('años',$años)->with('boton','boton');
        }
    }

    public function postVerInformesEmpresa(Request $request)
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
        return view('empresa.resultado_informes_empresa')
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
        ;//los informes no son correctos
    }

    public function getCambiarContraseña()
    {
    	return view('empresa.cambiar_contraseña');
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
        if ($validator->fails()){
            return redirect('empresa/cambiar_contraseña')->withErrors($validator);
        }
        else{
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
                $auditoria->operacion = "Cambio de Contraseña";
                $personas =DB::table('personas')->where('correo',Auth::user()->email)->get()->toArray();
                foreach ($personas as $persona)
                {
                    $cedula = $persona->cedula;
                    $nombre = $persona->nombres;
                    $apellido = $persona->apellidos;
                }
                $auditoria->descripcion = "Se procedio al cambio de contraseña del usuario: "."\n"
                ."Número de cédula: ".$cedula."\n"
                ."Nombre: ".$nombre."\n"
                ."Apellido: ".$apellido;

                $auditoria->save();
                //fin codigo auditoria

                return view('empresa/cambiar_contraseña')->with('status', 'Se ha actualizado la contraseña con éxito!!');
            }
            else
            {
               # return redirect('empresa/cambiar_contraseña')->with('message', 'Credenciales incorrectas');
                return view('empresa/cambiar_contraseña')->with('message', 'Credenciales incorrectas');
            }
        }
    }

}
