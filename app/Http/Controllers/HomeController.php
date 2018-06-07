<?php

namespace App\Http\Controllers;
use App\User;
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
            $rol = Auth::user()->id_rol;
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
                    return redirect('empresa');
                    break;
                case 6:
                    return redirect('oficial');
                    break;
            }
        }else{
            return view('login');
        }
    }
}
