<?php

namespace App\Http\Controllers;
use App\User;
use DB;
use App\Persona;
use App\Auditoria;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    

    public function index()
    {
        $id = Auth::user()->id;
        $roles= DB::table('personas')->where('id_usuario',$id)->get()->toArray();
        foreach ($roles as $role) 
        {
            $rol = $role->id_rol;
            $cedula = $role->cedula;
        }
         if (Auth::check()) 
        {
               switch ($rol) 
                {
                case 0:
                    Session::put('rol_usuario', $rol);
                    return redirect('sin_rol');
                    break;
                case 1:
                    Session::put('rol_usuario', $rol);
                    //registro de auditoria
                    $auditoria = new Auditoria();
                    $auditoria->fecha_hora = date('Y-m-d H:i:s');
                    $auditoria->cedula = $cedula;
                    $auditoria->rol = $rol;
                    $auditoria->ip = session()->get('ip_usuario');
                    $auditoria->operacion = "Inicio de sesión";
                    $auditoria->descripcion = "El usuario ingreso al sistema con el rol de empleado";
                    $auditoria->save();

                    return redirect('empleado');
                    break;
                case 2:
                    Session::put('rol_usuario', $rol);
                    //registro de auditoria
                    $auditoria = new Auditoria();
                    $auditoria->fecha_hora = date('Y-m-d H:i:s');
                    $auditoria->cedula = $cedula;
                    $auditoria->rol = $rol;
                    $auditoria->ip = session()->get('ip_usuario');
                    $auditoria->operacion = "Inicio de sesión";
                    $auditoria->descripcion = "El usuario puede ingresar con el rol de RRHH o Empleado";
                    $auditoria->save();

                    return view('auth/seleccionar_rol')->with('rol',$rol);
                    break;
                case 3:
                    Session::put('rol_usuario', $rol);
                    //registro de auditoria
                    $auditoria = new Auditoria();
                    $auditoria->fecha_hora = date('Y-m-d H:i:s');
                    $auditoria->cedula = $cedula;
                    $auditoria->rol = $rol;
                    $auditoria->ip = session()->get('ip_usuario');
                    $auditoria->operacion = "Inicio de sesión";
                    $auditoria->descripcion = "El usuario ingreso al sistema con el rol de empresa";
                    $auditoria->save();

                    return redirect('empresa');
                    break;
                case 4:
                    Session::put('rol_usuario', $rol);
                    //registro de auditoria
                    $auditoria = new Auditoria();
                    $auditoria->fecha_hora = date('Y-m-d H:i:s');
                    $auditoria->cedula = $cedula;
                    $auditoria->rol = $rol;
                    $auditoria->ip = session()->get('ip_usuario');
                    $auditoria->operacion = "Inicio de sesión";
                    $auditoria->descripcion = "El usuario puede ingresar con el rol de Empresa o Empleado";
                    $auditoria->save();

                    return view('auth/seleccionar_rol')->with('rol',$rol);
                    break;
                case 5:
                    Session::put('rol_usuario', $rol);
                    //registro de auditoria
                    $auditoria = new Auditoria();
                    $auditoria->fecha_hora = date('Y-m-d H:i:s');
                    $auditoria->cedula = $cedula;
                    $auditoria->rol = $rol;
                    $auditoria->ip = session()->get('ip_usuario');
                    $auditoria->operacion = "Inicio de sesión";
                    $auditoria->descripcion = "El usuario puede ingresar con el rol de Oficial de Seguridad o Empleado";
                    $auditoria->save();

                    return view('auth/seleccionar_rol')->with('rol',$rol);
                    break;
                }
        }
        else
        {
            return view('login');
        }
    }
    public function postRolSeleccionado(Request $request)
    { 
        $id = Auth::user()->id;
        $roles= DB::table('personas')->where('id_usuario',$id)->get()->toArray();
        foreach ($roles as $role) 
        {
            $rol = $role->id_rol;
            $cedula = $role->cedula;
        }
        switch ($request->rol_seleccionado) 
        {
            case 'empleado':
                //registro de auditoria
                $auditoria = new Auditoria();
                $auditoria->fecha_hora = date('Y-m-d H:i:s');
                $auditoria->cedula = $cedula;
                $auditoria->rol = $rol;
                $auditoria->ip = session()->get('ip_usuario');
                $auditoria->operacion = "Selección de rol";
                $auditoria->descripcion = "El usuario selecciono el rol de empleado";
                $auditoria->save();

                 return redirect('empleado');
                break;
            case 'empresa':
                //registro de auditoria
                $auditoria = new Auditoria();
                $auditoria->fecha_hora = date('Y-m-d H:i:s');
                $auditoria->cedula = $cedula;
                $auditoria->rol = $rol;
                $auditoria->ip = session()->get('ip_usuario');
                $auditoria->operacion = "Selección de rol";
                $auditoria->descripcion = "El usuario selecciono el rol de empresa";
                $auditoria->save();

                 return redirect('empresa');
                break;
            case 'rrhh':
                //registro de auditoria
                $auditoria = new Auditoria();
                $auditoria->fecha_hora = date('Y-m-d H:i:s');
                $auditoria->cedula = $cedula;
                $auditoria->rol = $rol;
                $auditoria->ip = session()->get('ip_usuario');
                $auditoria->operacion = "Selección de rol";
                $auditoria->descripcion = "El usuario selecciono el rol de RRHH";
                $auditoria->save();

                return redirect('rrhh');
                break;
            case 'oficial':
                //registro de auditoria
                $auditoria = new Auditoria();
                $auditoria->fecha_hora = date('Y-m-d H:i:s');
                $auditoria->cedula = $cedula;
                $auditoria->rol = $rol;
                $auditoria->ip = session()->get('ip_usuario');
                $auditoria->operacion = "Selección de rol";
                $auditoria->descripcion = "El usuario selecciono el rol de Oficial de Seguridad";
                $auditoria->save();

                return redirect('oficial');
                break;
        }
    }

    public function getlogin()
    {
        return view('login');

    }
    public function getSalirSistema()
    {
        $id = Auth::user()->id;
        $roles= DB::table('personas')->where('id_usuario',$id)->get()->toArray();
        foreach ($roles as $role) 
        {
            $rol = $role->id_rol;
            $cedula = $role->cedula;
        }
        //registro de auditoria
        $auditoria = new Auditoria();
        $auditoria->fecha_hora = date('Y-m-d H:i:s');
        $auditoria->cedula = $cedula;
        $auditoria->rol = $rol;
        $auditoria->ip = session()->get('ip_usuario');
        $auditoria->operacion = "Finalización de sesión";
        $auditoria->descripcion = "Salida del sistema";
        $auditoria->save();

        Session::forget('rol_usuario');
        Session::forget('ip_usuario');
        Auth::logout();
        return redirect('/');
    }
}
