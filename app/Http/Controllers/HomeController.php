<?php

namespace App\Http\Controllers;
use App\User;
use DB;
use App\Persona;
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
    public function index()
    {
         if (Auth::check()) 
        {
            $id = Auth::user()->id;
            $roles= DB::table('personas')->where('id_usuario',$id)->get()->toArray();
            foreach ($roles as $role) 
            {
                $rol = $role->id_rol;
            }
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
        else{
            return view('login');
        }
    }

    public function getlogin()
    {
        return view('login');

    }
    public function getSalirSistema()
    {
        Session::forget('rol_usuario');
        Auth::logout();
        return redirect('/');
    }
}
