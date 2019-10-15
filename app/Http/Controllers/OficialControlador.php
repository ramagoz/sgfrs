<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Persona;
use App\Auditoria;
use DB;
use DataTables;
use App\User;
use Illuminate\Support\Facades\Hash;
use Validator;
use Auth;

class OficialControlador extends Controller
{
    
     //devuelve a la vista en formato json los datos de los usuarios con rol de rrhh
    //para ser procesado por el datatable
    public function datatable()
    {
         $persona_rol= DB::table('personas')->where('id_rol', '2')->get();
         return Datatables::of($persona_rol)->make(true);

    }

    //devuelve a la vista en formato json los datos de los usuarios con rol de empresa
    //para ser procesado por el datatable
    public function datatableempresa()
    {
         $persona_rol= DB::table('personas')->where('id_rol', '3')->orWhere('id_rol', '4')->get();
         //return Datatables::of(Persona::query())->make(true);
         return Datatables::of($persona_rol)->make(true);

    }

        public function datatablerol()
    {
        // $persona_rol= DB::table('personas')->get();
         //return Datatables::of(Persona::query())->make(true);
        // return Datatables::of($persona_rol)->make(true);


            $persona_rol = DB::table('personas')
                 ->join('roles', 'personas.id_rol','=','roles.id_rol')->get();
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
     public function getModificacionRol(request $request)
    {  

        $persona =DB::table('personas')->where('cedula',$request->cedula)->get()->toArray();
        $nombre_rol = DB::table('roles')->select('rol','id_rol')->get();
       
        return view('oficial.modificacion_rol', compact('persona'),compact('nombre_rol'));
    }

    public function getIndexOficial()
    {
      // Creamos los datos de entrada para firma masiva
      $datos = [
      'tipo_firma'=>2,
      'firmante'=>1000000,
      'estado_recibo'=>1,
      //'id_recibo'=>'1111111-0119',
      'id_recibo'=>'1111111-0119,2222222-0119',
      'pass'=>'1111'];

      /*
      $datos = 
      [
      'tipo_firma'=>2,
      'firmante'=>1111111,
      'estado_recibo'=>1,
      'id_recibo'=>
          [
            '1' => '1111111-0119',
            '2' => '2222222-0119'
          ],
      'pass'=>'1111'
      ];*/

      // Este es el webservice que vamos a consumir
      $wsdl = 'http://localhost:8080/WebServicesTest/services/ServicioFirma?wsdl';

      $parametros=array('encoding' => 'UTF-8','trace' => 1,"verify_peer"=>false);

      // Creamos el cliente SOAP que hará la solicitud

      $cliente = new \SoapClient($wsdl,$parametros);

      // Consumimos el servicio llamando al método que necesitamos, en este caso
      // func() es un método definido dentro del WSDL 

      //dd($datos);
      $resultado = $cliente->func($datos);
      
    	return view('oficial.indexoficial')->with('res',$resultado);

      /*
      // Creamos los datos de entrada para firma unitaria
      $datos = [
      'tipo_firma'=>1,
      'firmante'=>1111111,
      'estado_recibo'=>1,
      'id_recibo'=>'1111111-0119',
      'pass'=>'1111'];

      // Este es el webservice que vamos a consumir
      $wsdl = 'http://localhost:8080/WebServicesTest/services/ServicioFirma?wsdl';

      $parametros=array('encoding' => 'UTF-8','trace' => 1,"verify_peer"=>false);

      // Creamos el cliente SOAP que hará la solicitud

      $cliente = new \SoapClient($wsdl,$parametros);

      // Consumimos el servicio llamando al método que necesitamos, en este caso
      // func() es un método definido dentro del WSDL 

      $resultado = $cliente->func($datos);
      
      return view('oficial.indexoficial')->with('res',$resultado);
      */
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

                //inicio codigo auditoria
                    $auditoria = new Auditoria();
                    $auditoria->fecha_hora = date('Y-m-d H:i:s');
                    $auditoria->cedula = session()->get('cedula_usuario');
                    $auditoria->rol = session()->get('rol_usuario');
                    $auditoria->ip = session()->get('ip_usuario');
                    $auditoria->operacion = "Alta de RRHH";
                    $auditoria->descripcion = "Se procedio a la alta en el sistema del usuario con rol de RRHH con los siguientes datos:"."\n"
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

                //inicio codigo auditoria
                    $auditoria = new Auditoria();
                    $auditoria->fecha_hora = date('Y-m-d H:i:s');
                    $auditoria->cedula = session()->get('cedula_usuario');
                    $auditoria->rol = session()->get('rol_usuario');
                    $auditoria->ip = session()->get('ip_usuario');
                    $auditoria->operacion = "Alta de empresa";
                    $auditoria->descripcion = "Se procedio a la alta en el sistema del usuario con rol de EMPRESA con los siguientes datos:"."\n"
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

        //inicio codigo auditoria
            $auditoria = new Auditoria();
            $auditoria->fecha_hora = date('Y-m-d H:i:s');
            $auditoria->cedula = session()->get('cedula_usuario');
            $auditoria->rol = session()->get('rol_usuario');
            $auditoria->ip = session()->get('ip_usuario');
            $auditoria->operacion = "Actualización datos de RRHH";
            $auditoria->descripcion = "Se procedio a la actualización de datos en el sistema del usuario con rol de RRHH con los siguientes datos:"."\n"
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
        return view('oficial.busqueda_rrhh')->with('msj','Los datos del usuario con CI Nro. '.$request->cedula.' se actualizaron correctamente!!!');
        
    }

     public function getRolModificado(Request $request)
    {   
      
        $persona =Persona::find($request->cedula);
    
        $persona->id_rol     = $request->rol;

        $persona->save();
       # return view('rrhh.empleado_cargado');
        return view('oficial.roles')->with('msjrol','Los datos del usuario con CI Nro. '.$request->cedula.' se actualizaron correctamente!!!');
        
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
        $persona->obs        = $request->observacion;
        $persona->save();

        //inicio codigo auditoria
            $auditoria = new Auditoria();
            $auditoria->fecha_hora = date('Y-m-d H:i:s');
            $auditoria->cedula = session()->get('cedula_usuario');
            $auditoria->rol = session()->get('rol_usuario');
            $auditoria->ip = session()->get('ip_usuario');
            $auditoria->operacion = "Actualización datos de EMPRESA";
            $auditoria->descripcion = "Se procedio a la actualización de datos en el sistema del usuario con rol de EMPRESA con los siguientes datos:"."\n"
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
        return view('oficial.busqueda_empresa')->with('msj','Los datos del usuario con CI Nro. '.$request->cedula.' se actualizaron correctamente!!!');
        
    }


     public function getRrhhDesactivado(Request $request)
    {   
      
        $persona =Persona::find($request->cedula);
        $persona->estado = $request->estado;
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

         //inicio codigo auditoria
            $auditoria = new Auditoria();
            $auditoria->fecha_hora = date('Y-m-d H:i:s');
            $auditoria->cedula = session()->get('cedula_usuario');
            $auditoria->rol = session()->get('rol_usuario');
            $auditoria->ip = session()->get('ip_usuario');
            $auditoria->operacion = "Desactivación acceso usuario";
            $auditoria->descripcion = "Se procedio a la Inactivación del acceso al sistema para el usuario con los siguientes datos:"."\n"
            ."Número de cédula: ".$request->cedula."\n"
            ."Nombre: ".$request->nombre."\n"
            ."Apellido: ".$request->apellido;

            $auditoria->save();
        //fin codigo auditoria

        return view('/oficial/busqueda_rrhh')->with('msjbaja','El usuario con CI Nro. '.$request->cedula.' se desactivo del Sistema !!!');
        
    }

      public function getEmpresaDesactivado(Request $request)
    {   
      
        $persona =Persona::find($request->cedula);
        $persona->estado = $request->estado;
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

         //inicio codigo auditoria
            $auditoria = new Auditoria();
            $auditoria->fecha_hora = date('Y-m-d H:i:s');
            $auditoria->cedula = session()->get('cedula_usuario');
            $auditoria->rol = session()->get('rol_usuario');
            $auditoria->ip = session()->get('ip_usuario');
            $auditoria->operacion = "Desactivación acceso usuario";
            $auditoria->descripcion = "Se procedio a la Inactivación del acceso al sistema para el usuario con los siguientes datos:"."\n"
            ."Número de cédula: ".$request->cedula."\n"
            ."Nombre: ".$request->nombre."\n"
            ."Apellido: ".$request->apellido;

            $auditoria->save();
        //fin codigo auditoria

        return view('/oficial/busqueda_empresa')->with('msjbaja','El usuario con CI Nro. '.$request->cedula.' se desactivo del Sistema !!!');
        
    }

     public function getRrhhActivado(Request $request)
    {   
      
        $persona =Persona::find($request->cedula);
        $persona->estado     = $request->estado;
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

         //inicio codigo auditoria
            $auditoria = new Auditoria();
            $auditoria->fecha_hora = date('Y-m-d H:i:s');
            $auditoria->cedula = session()->get('cedula_usuario');
            $auditoria->rol = session()->get('rol_usuario');
            $auditoria->ip = session()->get('ip_usuario');
            $auditoria->operacion = "Activación acceso usuario";
            $auditoria->descripcion = "Se procedio a la Activación del acceso al sistema para el usuario con los siguientes datos:"."\n"
            ."Número de cédula: ".$request->cedula."\n"
            ."Nombre: ".$request->nombre."\n"
            ."Apellido: ".$request->apellido;

            $auditoria->save();
        //fin codigo auditoria

        return view('/oficial/busqueda_rrhh')->with('msjactivado','El usuario con CI Nro. '.$request->cedula.' se activo correctamente!!');
        
    }

     public function getEmpresaActivado(Request $request)
    {   
      
        $persona =Persona::find($request->cedula);
        $persona->estado     = $request->estado;
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

        //inicio codigo auditoria
            $auditoria = new Auditoria();
            $auditoria->fecha_hora = date('Y-m-d H:i:s');
            $auditoria->cedula = session()->get('cedula_usuario');
            $auditoria->rol = session()->get('rol_usuario');
            $auditoria->ip = session()->get('ip_usuario');
            $auditoria->operacion = "Activación acceso usuario";
            $auditoria->descripcion = "Se procedio a la Activación del acceso al sistema para el usuario con los siguientes datos:"."\n"
            ."Número de cédula: ".$request->cedula."\n"
            ."Nombre: ".$request->nombre."\n"
            ."Apellido: ".$request->apellido;

            $auditoria->save();
        //fin codigo auditoria

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
    	return view('oficial.auditoria');
    }
    public function getDatatableAuditoria()
    {
       $registros = DB::table('auditorias')->get();
       return Datatables::of($registros)->make(true);
    }
    public function getRestablecerContraseña()
    {
    	return view('oficial.restablecer_contraseña');
    }
    public function getCambiarContraseña()
    {
        return view('oficial.cambiar_contraseña');
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
            'password.min' => 'El mínimo permitido son 4 caracteres',
            'password.max' => 'El máximo permitido son 18 caracteres',
        ];
        
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()){
            return redirect('oficial/cambiar_contraseña')->withErrors($validator);
        }
        else{
            if (Hash::check($request->mypassword, Auth::user()->password))
            {
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


                return view('oficial/cambiar_contraseña')->with('status', 'Se ha actualizado la contraseña con éxito!!');
            }
            else
            {
                return view('oficial/cambiar_contraseña')->with('message', 'Credenciales incorrectas');
            }
        }
    }
}
