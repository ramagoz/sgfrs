<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Persona;
use DB;
use Illuminate\Support\Facades\Auth;
use App\Notifications\NotificarEmpleador;
use App\Notifications\NotificarEmpleados;
use Illuminate\Support\Facades\Notification;

class NotificaciónControlador extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
			    public function NotifyEmpleador()
			    {
			              
			     
			         $fromUser = session()->get('name');
                     # $toUser = User::find(1);
			    	 #$fromUser = User::where("email","=","b@b.c");*/
			        
			         $toUser = User::join("personas","users.email","=","personas.correo")->whereIn('personas.id_rol', [3,4])->get();       
			     		         
			        // send notification using the "Notification" facade
			        Notification::send($toUser, new NotificarEmpleador($fromUser));
			    }

			    public function NotifyEmpleadoUnitario($cedula)
			    {
			              
			         
			         $fromUser = session()->get('name');
                     # $toUser = User::find(1);
			    	 #$fromUser = User::where("email","=","b@b.c");*/
			        
			         $toUser = User::join("personas","users.email","=","personas.correo")->where('personas.cedula','=',"$cedula")->get();
			         	#echo  $toUser;


			     		         
			        // send notification using the "Notification" facade
			        Notification::send($toUser, new NotificarEmpleados($fromUser));
			    }
}
