<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Persona;
use DB;
use DataTables;
use App\User;
use Illuminate\Support\Facades\Hash;

class OficialControlador extends Controller
{
    
     //devuelve a la vista en formato json los datos de los empleados
    //para ser procesado por el datatable
    public function datatable()
    {
         $persona_rol= DB::table('personas')->where('id_rol', '2')->get();
         //return Datatables::of(Persona::query())->make(true);
         return Datatables::of($persona_rol)->make(true);

    }

    public function getRecuperarGrupo(request $request)
    {

        $persona =DB::table('personas')->where('cedula',$request->cedula)->get()->toArray();
        $nombre_grupos = DB::table('grupos_recibos')->select('nombre_grupo','id_grupo')->get();


      foreach ($persona as $person) 
                    {
                        $estado = $person->estado;

                    }

     if ($estado=='1')
       {
        return view('oficial.desactivar_empleado', compact('persona'),compact('nombre_grupos'));
        }
    else
    {
        return view('oficial.activar_empleado', compact('persona'),compact('nombre_grupos'));
    }
   }

     public function getModificacionEmpleado(request $request)
    {  

        $persona =DB::table('personas')->where('cedula',$request->cedula)->get()->toArray();
        $nombre_grupos = DB::table('grupos_recibos')->select('nombre_grupo','id_grupo')->get();
       
        return view('oficial.modificacion_rrhh', compact('persona'),compact('nombre_grupos'));
    }

     public function getAltaEmpleado()
    {
        //Consulta DB para ver grupos disponibles los compacta en de array y los envia a la vista//
        $nombre_grupos = DB::table('grupos_recibos')->select('nombre_grupo','id_grupo')->get();
        return view('oficial.alta_empleado', compact('nombre_grupos'));
    }

    public function getIndexOficial()
    {
    	return view('oficial.indexoficial');
    }

    public function postRrhhCargado(Request $request)
    {
       //validacion si el usuario a cargar ya no existe
        $validemail=DB::table('users')->where('email',$request->correo)->get();
         if ($validemail=='[]') 
             { // usuario no existe
          $validcedula=DB::table('personas')->where('cedula',$request->cedula)->get();
          if($validcedula=='[]') //persona no existe, se puede proceder a crear usuario y persona
          {
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
                    $id_rol='2';
                    $persona->id_rol   = $id_rol;
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
                    return view('oficial.busqueda_rrhh')->with('$msjcargado','Se un registro el usuario con CI Nro. '.$request->cedula);

          }
          else{
                
                return view('/oficial/busqueda_rrhh')->with('errorpersona','Ya existe un registro de usuario con CI Nro. '.$request->cedula);
                }

        }         
          else{
                 return view('/oficial/busqueda_rrhh')->with('erroruser','Ya existe un registro de usuario con el correo '.$request->correo);
                }

    }


       public function getAltaRrhh()
    {
        //Consulta DB para ver grupos disponibles los compacta en de array y los envia a la vista//
        $nombre_grupos = DB::table('grupos_recibos')->select('nombre_grupo','id_grupo')->get();
        return view('oficial.alta_rrhh', compact('nombre_grupos'));
    }

    public function getBajaRrhh()
    {
    	return view('oficial.baja_rrhh');
    }
    public function getModificacionRrhh()
    {
    	return view('oficial.modificacion_rrhh');
    }
    public function getBusquedaRrhh()
    {
    	return view('oficial.busqueda_rrhh');
    }
    public function getAltaEmpresa()
    {
    	return view('oficial.alta_empresa');
    }
    public function getBajaEmpresa()
    {
    	return view('oficial.baja_empresa');
    }
    public function getModificacionEmpresa()
    {
    	return view('oficial.modificacion_empresa');
    }
    public function getBusquedaEmpresa()
    {
    	return view('oficial.busqueda_empresa');
    }
    public function getRoles()
    {
    	return view('oficial.roles');
    }
    public function getAuditoria()
    {
    	return view('oficial.auditoria');
    }
    public function getRestablecerContraseña()
    {
    	return view('oficial.restablecer_contraseña');
    }
    public function getCambiarContraseña()
    {
    	return view('oficial.cambiar_contraseña');
    }
}
