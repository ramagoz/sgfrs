<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Recibo;
use App\Grupo_recibo;
use App\Periodo;
use App\Persona;
use App\Auditoria;
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
        ->get();
        if ($recibos=='[]')
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
    public function getFirmarReciboPendienteEmpleado($id)
    {
        $recibo =Recibo::find($id);
        $recibo->id_estado_recibo =3;
        $recibo->save();
        $mes=substr($id, -4,2);
        $año=substr($id, -2,2);
        $dir_origen= "C:/xampp/htdocs/sgfrs/public/recibos/firmados_empresa/20" . $año . "/" . $mes . "/";
         $dir_destino= "C:/xampp/htdocs/sgfrs/public/recibos/firmados_empresa_empleados/20" . $año . "/" . $mes . "/";
        rename($dir_origen.$id.'.pdf' , $dir_destino.$id.'.pdf');
        
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
     public function postFirmaMasivaRecibosPendientesEmpleado(Request $request)
    {
        //aqui se recuperan los identificadores de recibos que fueron selecionados para ser firmados
        foreach ($request->recibos_a_firmar as $key => $value) 
        {
            $recibo =Recibo::find($value);
            $recibo->id_estado_recibo =3;
            $recibo->save();
            $mes=substr($value, -4,2);
            $año=substr($value, -2,2);
            $dir_origen= "C:/xampp/htdocs/sgfrs/public/recibos/firmados_empresa/20" . $año . "/" . $mes . "/";
            $dir_destino= "C:/xampp/htdocs/sgfrs/public/recibos/firmados_empresa_empleados/20" . $año . "/" . $mes . "/";
            rename($dir_origen.$value.'.pdf' , $dir_destino.$value.'.pdf');
            //inicio codigo auditoria
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
        ->get();

        return view('empleado.recibos_firmados')->with('recibos',$recibos)->with('msj','Recibos firmados correctamente!');
    }


    public function getRecibosFirmados()
    {
        $recibos = DB::table('recibos')
        ->join('personas', 'recibos.cedula','=','personas.cedula')
        ->where('recibos.id_estado_recibo', '3')
        ->where('personas.correo', Auth::user()->email)
        ->get();
        if ($recibos=='[]')
        {
            return view('empleado.recibos_firmados')->with('recibos',$recibos)->with('msj_error','No se encontraron recibos firmados');;
        }else
        {
            return view('empleado.recibos_firmados')->with('recibos',$recibos);
        }
    }

    public function getVerReciboFirmadoEmpresaEmpleado($id)
    {
        $mes=substr($id, -4,2);
        $año=substr($id, -2,2);
        $id="/recibos/firmados_empresa_empleados/20". $año . "/" . $mes."/".$id.".pdf";
        return view('empleado.ver_recibo_firmado_empresa_empleado')->with('id',$id);
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
            'password.confirmed' => 'Los passwords no coinciden',
            'password.min' => 'El mínimo permitido son 6 caracteres',
            'password.max' => 'El máximo permitido son 18 caracteres',
        ];
        
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()){
            return redirect('empleado/cambiar_contraseña')->withErrors($validator);
        }
        else{
            if (Hash::check($request->mypassword, Auth::user()->password)){
                $user = new User;
                $user->where('email', '=', Auth::user()->email)
                     ->update(['password' => bcrypt($request->password)]);
                #return redirect('empresa/cambiar_contraseña')->with('status', 'Password cambiado con éxito');
                return view('empleado/cambiar_contraseña')->with('status', 'Se ha actualizado la contraseña con éxito!!');
            }
            else
            {
               # return redirect('empresa/cambiar_contraseña')->with('message', 'Credenciales incorrectas');
                return view('empleado/cambiar_contraseña')->with('message', 'Credenciales incorrectas');
            }
        }
    }
}
