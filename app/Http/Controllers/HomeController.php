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
                    return redirect('empleado');
                    break;
                case 2:
                    Session::put('rol_usuario', $rol);
                    return view('auth/seleccionar_rol')->with('rol',$rol);
                    break;
                case 3:
                    Session::put('rol_usuario', $rol);
                    //registro de auditoria para ingreso al sistema
                    $auditoria = new Auditoria();
                    $auditoria->fecha_hora = date('Y-m-d H:i:s');
                    $auditoria->cedula = $cedula;
                    $auditoria->rol = $rol;
                    $auditoria->ip = session()->get('ip_usuario');
                    $auditoria->operacion = "inicio de sesión";
                    $auditoria->descripcion = "ingreso al sistema";
                    $auditoria->save();

                    return redirect('empresa');
                    break;
                case 4:
                    Session::put('rol_usuario', $rol);
                    return view('auth/seleccionar_rol')->with('rol',$rol);
                    break;
                case 5:
                    Session::put('rol_usuario', $rol);
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
        switch ($request->rol_seleccionado) 
        {
            case 'empleado':
                 return redirect('empleado');
                break;
            case 'empresa':
                 return redirect('empresa');
                break;
            case 'rrhh':
                 return redirect('rrhh');
                break;
            case 'oficial':
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
        //registro de auditoria para salida del sistema
        $auditoria = new Auditoria();
        $auditoria->fecha_hora = date('Y-m-d H:i:s');
        $auditoria->cedula = $cedula;
        $auditoria->rol = $rol;
        $auditoria->ip = session()->get('ip_usuario');
        $auditoria->operacion = "finalización de sesión";
        $auditoria->descripcion = "salida del sistema";
        $auditoria->save();

        Session::forget('rol_usuario');
        Session::forget('ip_usuario');
        Auth::logout();
        return redirect('/');
    }
}
