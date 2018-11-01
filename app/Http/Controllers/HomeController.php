<?php

namespace App\Http\Controllers;
use App\User;
use DB;
use App\Persona;
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
         if (Auth::check()) 
        {
            $id = Auth::user()->id;
            $roles= DB::table('personas')->where('id_usuario',$id)->get()->toArray();
        foreach ($roles as $role) {

            $rol = $role->id_usuario;
        }
       switch ($rol) 
            {
                case 0:
                    return redirect('sin_rol');
                    break;
                case 1:
                    return redirect('empleado');
                    break;
                case 2:
                    return redirect('rrhh');
                    break;
                case 3:
                    return redirect('empresa');
                    break;
                case 4:
                    return redirect('empresa');
                    break;
                case 5:
                    return redirect('oficial');
                    break;
            }
        }else{
            return view('login');
        }
    }
}
