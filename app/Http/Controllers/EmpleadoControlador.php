<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ValidacionCargaUsuario;
use App\Recibo;
use App\Grupo_recibo;
use App\Periodo;
use App\Persona;
use App\Auditoria;
use App\User;
use Validator;
use DB;

class EmpleadoControlador extends Controller
{
    public function getIndexEmpleado()
    {
    	return view('empleado.indexempleado');
    }
    public function getRecibosPendientes()
    {

        $recibos = DB::table('recibos')
        ->join('personas', 'recibos.cedula','=','personas.cedula')
        ->where('recibos.id_estado_recibo', '2')
        ->where('personas.correo', Auth::user()->email)
        ->paginate(8);
        if ($recibos->count() ==0)
        {
            return view('empleado.recibos_pendientes')->with('recibos',$recibos)->with('msj','No existen recibos pendientes de firma por el empleado!');
        }else
        {
            return view('empleado.recibos_pendientes')->with('recibos',$recibos)->with('boton','boton');
        }

    }
    public function getVerReciboPendienteFirmaEmpleado($id)
    {
        $id_recibo=$id;
        $id="/recibos/firmados_empresa/"."20".substr($id, -2, 2)."/".substr($id, -4, 2)."/".$id.".pdf";
        return view('empleado.ver_recibo_pendiente_firma_empleado')->with('id',$id)->with('id_recibo',$id_recibo);
    }
    public function postFirmarRecibo(Request $request)
    {
        //Servicio de firma
        $datos = [
        'tipo_firma'=>1,
        'firmante'=>session()->get('cedula_usuario'),
        'estado_recibo'=>2,
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
        $id="/recibos/firmados_empresa/20". $año . "/" . $mes."/".$id.".pdf";
        return view('empleado.ver_recibo_pendiente_firma_empleado')->with('id',$id)->with('id_recibo',$id_recibo)->with('error',$resultado->funcReturn);
        }
        //fin servicio firma

        $recibo =Recibo::find($id);
        $recibo->id_estado_recibo =3;
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

        $id="/recibos/firmados_empresa_empleados/20". $año . "/" . $mes."/".$id.".pdf";
        return view('empleado.ver_recibo_firmado_empleado')->with('id',$id)->with('msj','Recibo firmado correctamente!');
    }

     public function postFirmaMasiva(Request $request)
    {
        //aqui se recuperan los identificadores de recibos que fueron selecionados para ser firmados
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
            ->where('recibos.id_estado_recibo', '2')
            ->where('personas.correo', Auth::user()->email)
            ->paginate(8);
            return view('empleado.recibos_pendientes')->with('recibos',$recibos)->with('error','No ha selecionado ningun recibo')->with('boton','boton');
        }
        //Servicio de firma
          $datos = [
          'tipo_firma'=>2,
          'firmante'=>session()->get('cedula_usuario'),
          'estado_recibo'=>2,
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
                ->where('recibos.id_estado_recibo', '2')
                ->where('personas.correo', Auth::user()->email)
                ->paginate(8);
                return view('empleado.recibos_pendientes')->with('recibos',$recibos)->with('error',$resultado->funcReturn)->with('boton','boton');
            }
            //fin servicio firma
        //inicio codigo de autitoria
        foreach ($request->recibos_a_firmar as $key => $value)
        {
            $recibo =Recibo::find($value);
            $recibo->id_estado_recibo =3;
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
        ->where('recibos.id_estado_recibo', '3')
        ->where('personas.correo', Auth::user()->email)
        ->paginate(8);

        return view('empleado.recibos_firmados')->with('recibos',$recibos)->with('msj','Recibos firmados correctamente!')->with('boton','boton');
    }


    public function getRecibosFirmados()
    {
        $recibos = DB::table('recibos')
        ->join('personas', 'recibos.cedula','=','personas.cedula')
        ->where('recibos.id_estado_recibo', '3')
        ->where('personas.correo', Auth::user()->email)
         ->paginate(8);
        if ($recibos->count()==0)
        {
            return view('empleado.recibos_firmados')->with('recibos',$recibos)->with('msj_error','No se encontraron recibos firmados');
        }else
        {
            return view('empleado.recibos_firmados')->with('recibos',$recibos)->with('boton','boton');
        }
    }

    public function getVerReciboFirmadoEmpresaEmpleado($id)
    {
        $mes=substr($id, -4,2);
        $año=substr($id, -2,2);
        $id="/recibos/firmados_empresa_empleados/20". $año . "/" . $mes."/".$id.".pdf";
        return view('empleado.ver_recibo_firmado_empleado')->with('id',$id);
    }

    public function getContactarRrhh()
    {
    	return view('empleado.contactar_rrhh');
    }
    public function getCambiarContraseña()
    {
        return view('empleado.cambiar_contraseña');
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
            'password.confirmed' => 'Las contraseñas ingresadas no coinciden',
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

                return view('empleado/cambiar_contraseña')->with('msj', 'Se ha actualizado la contraseña con éxito!!');
            }
            else
            {
                return view('empleado/cambiar_contraseña')->with('error', 'La contraseña actual ingresada es incorrecta');
            }
        }
    }
}
