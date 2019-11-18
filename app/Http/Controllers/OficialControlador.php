<?php

namespace App\Http\Controllers;
use App\Http\Requests\ValidacionCargaUsuario;
use App\Http\Requests\ValidacionActualizacionUsuario;
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
    public function getIndexOficial()
    {
      return view('oficial.indexoficial');
    }
    public function datatable()//Devuelve datos de usuarios rol rrhh para el datatables
    {
         $persona_rol= DB::table('personas')->where('id_rol', '2')->get();
         return Datatables::of($persona_rol)->make(true);
    }
    public function datatableempresa()//Devuelve datos de usuarios rol empresa para el datatables
    {
         $persona_rol= DB::table('personas')->where('id_rol', '3')->orWhere('id_rol', '4')->get();
         //return Datatables::of(Persona::query())->make(true);
         return Datatables::of($persona_rol)->make(true);
    }
    public function datatablerol()//Devuelve datos todos los usuarios para el datatables
    {
      $persona_rol = DB::table('personas')
           ->join('roles', 'personas.id_rol','=','roles.id_rol')->get();
      return Datatables::of($persona_rol)->make(true);
    }
    public function getBusquedaRrhh()
    {
        $datos= DB::table('personas')->where('id_rol', '2')->count();
        if ($datos > 0)
        {
            return view('oficial.busqueda_rrhh');
        }
        else
        {
            return view('oficial.busqueda_rrhh')->with('error', 'No existen usuarios con rol de RRHH');
        }
    }
    public function getBusquedaEmpresa()
    {
        $datos= DB::table('personas')->where('id_rol', '3')->orWhere('id_rol', '4')->count();
        if ($datos > 0)
        {
            return view('oficial.busqueda_empresa');
        }
        else
        {
            return view('oficial.busqueda_empresa')->with('error', 'No existen usuarios con rol de Empresa');
        }
    }
    public function getAltaRrhh()
    {

      return view('oficial.alta_rrhh');
    }
    public function getAltaEmpresa()
    {

      return view('oficial.alta_empresa');
    }
    public function postRrhhCargado(ValidacionCargaUsuario $request)
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
      $persona->id_rol     = 2;
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
      return view('oficial.busqueda_rrhh')->with('$msj','Se un registro el usuario con CI Nro. '.$request->cedula);
    }
    public function postEmpresaCargado(ValidacionCargaUsuario $request)
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
      $persona->id_rol     = 3;
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

      return view('oficial.busqueda_empresa')->with('msj','Se registro al usuario '.$request->nombre.' '.$request->apellido.' con CI Nro.: '.$request->cedula);
    }
    public function getModificacionRrhh($cedula)
    {

        $persona =DB::table('personas')->where('cedula',$cedula)->first();
        return view('oficial.modificacion_rrhh', compact('persona'));
    }
    public function getModificacionEmpresa($cedula)
    {

        $persona =DB::table('personas')->where('cedula',$cedula)->first();
        return view('oficial.modificacion_empresa')->with('persona',$persona);
    }
    public function postRrhhModificado(ValidacionActualizacionUsuario $request)
    {
      $persona =Persona::find($request->cedula);
      $consulta = DB::table('personas')->where('correo',$request->correo)->get();
      if ($persona->correo <> $request->correo and $consulta <> '[]')
      {
          return view('oficial.modificacion_rrhh')->with('error','Este correo ya esta asignado a otro usuario')->with('persona',$request);
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
          $auditoria->operacion = "Actualización datos de RRHH";
          $auditoria->descripcion = "Se procedio a la actualización de datos en el sistema del usuario con rol de RRHH con los siguientes datos:"."\n"
          ."número de cédula: ".$request->cedula."\n"
          ."Nombre: ".$request->nombres."\n"
          ."Apellido: ".$request->apellidos."\n"
          ."Cel.: ".$request->cel."\n"
          ."Tel.: ".$request->tel."\n"
          ."Correo: ".$request->correo."\n"
          ."Dpto.: ".$request->dpto."\n"
          ."Cargo: ".$request->cargo."\n"
          ."Obs.: ".$request->obs;

          $auditoria->save();
      //fin codigo auditoria

      return view('oficial.busqueda_rrhh')->with('msj','Los datos del usuario con CI Nro. '.$request->cedula.' se actualizaron correctamente!!!');
    }
    public function postEmpresaModificado(ValidacionActualizacionUsuario $request)
    {
        $persona =Persona::find($request->cedula);
        $consulta = DB::table('personas')->where('correo',$request->correo)->get();
        if ($persona->correo <> $request->correo and $consulta <> '[]')
        {
            return view('oficial.modificacion_empresa')->with('error','Este correo ya esta asignado a otro usuario')->with('persona',$request);
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
          $auditoria->operacion = "Actualización datos de EMPRESA";
          $auditoria->descripcion = "Se procedio a la actualización de datos en el sistema del usuario con rol de EMPRESA con los siguientes datos:"."\n"
          ."número de cédula: ".$request->cedula."\n"
          ."Nombre: ".$request->nombres."\n"
          ."Apellido: ".$request->apellidos."\n"
          ."Cel.: ".$request->cel."\n"
          ."Tel.: ".$request->tel."\n"
          ."Correo: ".$request->correo."\n"
          ."Dpto.: ".$request->dpto."\n"
          ."Cargo: ".$request->cargo."\n"
          ."Obs.: ".$request->obs;

          $auditoria->save();
        //fin codigo auditoria
        return view('oficial.busqueda_empresa')->with('msj','Los datos del usuario con CI Nro. '.$request->cedula.' se actualizaron correctamente!!!');
    }
    public function getRolModificado(Request $request)
    {

        $persona =Persona::find($request->cedula);

        $persona->id_rol     = $request->rol;

        $persona->save();

        return view('oficial.roles')->with('msjrol','Los datos del usuario con CI Nro. '.$request->cedula.' se actualizaron correctamente!!!');
    }
    public function getModificacionRol(request $request)
    {

        $persona =DB::table('personas')->where('cedula',$request->cedula)->get()->toArray();
        $nombre_rol = DB::table('roles')->select('rol','id_rol')->get();

        return view('oficial.modificacion_rol', compact('persona'),compact('nombre_rol'));
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
