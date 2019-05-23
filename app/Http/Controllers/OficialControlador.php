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

         //devuelve a la vista en formato json los datos de los empleados
    //para ser procesado por el datatable
    public function datatableempresa()
    {
         $persona_rol= DB::table('personas')->where('id_rol', '3')->orWhere('id_rol', '4')->get();
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
        return view('oficial.desactivar_rrhh', compact('persona'),compact('nombre_grupos'));
        }
    else
    {
        return view('oficial.activar_rrhh', compact('persona'),compact('nombre_grupos'));
    }
   }


   public function getRecuperarGrupoEmpresa(request $request)
    {

        $persona =DB::table('personas')->where('cedula',$request->cedula)->get()->toArray();
        $nombre_grupos = DB::table('grupos_recibos')->select('nombre_grupo','id_grupo')->get();


      foreach ($persona as $person) 
                    {
                        $estado = $person->estado;

                    }

     if ($estado=='1')
       {
        return view('oficial.desactivar_empresa', compact('persona'),compact('nombre_grupos'));
        }
    else
    {
        return view('oficial.activar_empresa', compact('persona'),compact('nombre_grupos'));
    }
   }

     public function getModificacionRhh(request $request)
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

     public function postEmpresaCargado(Request $request)
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
                    $persona->id_rol     = $request->rol;
                    $id_grupo='1';
                    $persona->id_grupo   = $id_grupo;
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
                    return view('oficial.busqueda_empresa')->with('$msjcargado','Se un registro el usuario con CI Nro. '.$request->cedula);

          }
          else{
                
                return view('/oficial/busqueda_empresa')->with('errorpersona','Ya existe un registro de usuario con CI Nro. '.$request->cedula);
                }

        }         
          else{
                 return view('/oficial/busqueda_empresa')->with('erroruser','Ya existe un registro de usuario con el correo '.$request->correo);
                }

    }

       public function getAltaRrhh()
    {
        //Consulta DB para ver grupos disponibles los compacta en de array y los envia a la vista//
        $nombre_grupos = DB::table('grupos_recibos')->select('nombre_grupo','id_grupo')->get();
        return view('oficial.alta_rrhh', compact('nombre_grupos'));
    }

     public function getAltaEmpresa()
    {
        //Consulta DB para ver grupos disponibles los compacta en de array y los envia a la vista//
        $nombre_grupos = DB::table('grupos_recibos')->select('nombre_grupo','id_grupo')->get();
        return view('oficial.alta_empresa', compact('nombre_grupos'));
    }
  
    public function getModificacionRrhh(request $request)
    {  

        $persona =DB::table('personas')->where('cedula',$request->cedula)->get()->toArray();
        $nombre_grupos = DB::table('grupos_recibos')->select('nombre_grupo','id_grupo')->get();
       
        return view('oficial.modificacion_rrhh', compact('persona'),compact('nombre_grupos'));
    }

       public function getModificacionEmpresa(request $request)
    {  

        $persona =DB::table('personas')->where('cedula',$request->cedula)->get()->toArray();
        $nombre_grupos = DB::table('grupos_recibos')->select('nombre_grupo','id_grupo')->get();
       
        return view('oficial.modificacion_empresa', compact('persona'),compact('nombre_grupos'));
    }

    public function getRrhhModificado(Request $request)
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
       # $persona->estado     = $request->estado;
        $persona->obs        = $request->observacion;
        $persona->save();
       # return view('rrhh.empleado_cargado');
        return view('oficial.busqueda_rrhh')->with('msj','Los datos del usuario con CI Nro. '.$request->cedula.' se actualizaron correctamente!!!');
        
    }

      public function getEmpresaModificado(Request $request)
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
       # $persona->estado     = $request->estado;
        $persona->obs        = $request->observacion;
        $persona->save();
       # return view('rrhh.empleado_cargado');
        return view('oficial.busqueda_empresa')->with('msj','Los datos del usuario con CI Nro. '.$request->cedula.' se actualizaron correctamente!!!');
        
    }


     public function getRrhhDesactivado(Request $request)
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
       
        #user baja
        $iduser = DB::table('users')->where('email', $request->correo)->get()->toArray();
                foreach ($iduser as $users) 
                    {
                        $id = $users->id;
                    }

         $user=User::find($id);
         $user->status=   $request->estado;
         $user->save();


       # return view('rrhh.empleado_cargado');
        return view('/oficial/busqueda_rrhh')->with('msjbaja','El usuario con CI Nro. '.$request->cedula.' se desactivo del Sistema !!!');
        
    }

      public function getEmpresaDesactivado(Request $request)
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
       
        #user baja
        $iduser = DB::table('users')->where('email', $request->correo)->get()->toArray();
                foreach ($iduser as $users) 
                    {
                        $id = $users->id;
                    }

         $user=User::find($id);
         $user->status=   $request->estado;
         $user->save();


       # return view('rrhh.empleado_cargado');
        return view('/oficial/busqueda_empresa')->with('msjbaja','El usuario con CI Nro. '.$request->cedula.' se desactivo del Sistema !!!');
        
    }

     public function getRrhhActivado(Request $request)
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
       
        #user baja
        $iduser = DB::table('users')->where('email', $request->correo)->get()->toArray();
                foreach ($iduser as $users) 
                    {
                        $id = $users->id;
                    }

         $user=User::find($id);
         $user->status=   $request->estado;
         $user->save();


       # return view('rrhh.empleado_cargado');
        return view('/oficial/busqueda_empresa')->with('msjactivado','El usuario con CI Nro. '.$request->cedula.' se activo correctamente!!');
        
    }

     public function getEmpresaActivado(Request $request)
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
       
        #user baja
        $iduser = DB::table('users')->where('email', $request->correo)->get()->toArray();
                foreach ($iduser as $users) 
                    {
                        $id = $users->id;
                    }

         $user=User::find($id);
         $user->status=   $request->estado;
         $user->save();


       # return view('rrhh.empleado_cargado');
        return view('/oficial/busqueda_empresa')->with('msjactivado','El usuario con CI Nro. '.$request->cedula.' se activo correctamente!!');
        
    }

    public function getBajaRrhh()
    {
    	return view('oficial.baja_rrhh');
    }

    public function getBusquedaRrhh()
    {
    	return view('oficial.busqueda_rrhh');
    }
      public function getBusquedaEmpresa()
    {
        return view('oficial.busqueda_empresa');
    }
    public function getBajaEmpresa()
    {
    	return view('oficial.baja_empresa');
    }
    public function getRoles()
    {
    	return view('oficial.roles');
    }
    public function getAuditoria()
    {
        echo 'Nombre computadora cliente: '.gethostname();
        echo "</br>";
        echo "Dirección IP del cliente: ".$_SERVER['REMOTE_ADDR'];
        echo "</br>";
        echo 'Fecha y hora del servidor: '.date('d-m-Y H:i');
        echo "</br>";
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
