<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Rol;
use App\User;
use App\Grupo_recibo;
use App\Estado_recibo;
use App\Periodo;
use App\Importacion;
use App\Persona;
use App\Empleado_sin_recibo;
use App\Recibo;
use App\Auditoria;
use App\Firma_empresa;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        self::seedRol();
  		$this->command->info('Tabla de Roles inicializada con datos!');
        
        self::seedUser();
        $this->command->info('Tabla de Usuarios inicializada con datos!');
    }
     private function seedRol()
    {
    	DB::table('roles')->delete();

    	foreach( $this->arrayRoles as $roles) 
    	{
	    $p = new Rol;
	    $p->id_rol = $roles['id_rol'];
	    $p->rol = $roles['rol'];
	    $p->save();
		}

    }

        private function seedUser()
    {
    	DB::table('users')->delete();

        foreach( $this->arrayUsers as $users) 
        {
        $p1 = new User;
        $p1->name = $users['name'];
        $p1->email = $users['email'];
        $p1->password = $users['password'];
        $p1->id_rol = $users['id_rol'];
        $p1->save();
        }
    }
        private function seedGrupo_recibo()
    {
    	DB::table('grupos_recibos')->delete();


    }
        private function seedEstado_recibo()
    {
    	DB::table('estado_recibos')->delete();


    }
        private function seedPeriodo()
    {
    	DB::table('periodos')->delete();


    }
        private function seedImportacion()
    {
    	DB::table('importaciones')->delete();


    }
        private function seedPersona()
    {
    	DB::table('personas')->delete();


    }
        private function seedEmpleado_sin_recibo()
    {
    	DB::table('empleados_sin_recibos')->delete();


    }
        private function seedRecibo()
    {
    	DB::table('recibos')->delete();


    }
        private function seedAuditoria()
    {
    	DB::table('auditorias')->delete();


    }
        private function seedFirma_empresa()
    {
    	DB::table('firma_empresas')->delete();

    }

    private $arrayRoles = 
    array(
		array(
			'id_rol' => 0,
			'rol' => 'sin rol',
			),
		array(
			'id_rol' => 1,
			'rol' => 'empleado',
			),
		array(
			'id_rol' => 2,
			'rol' => 'rrhh - empleado',
			),
		array(
			'id_rol' => 3,
			'rol' => 'empresa 0',
			),
		array(
			'id_rol' => 4,
			'rol' => 'empresa 1',
			),
		array(
			'id_rol' => 5,
			'rol' => 'empresa 1 - empleado',
			),
		array(
			'id_rol' => 6,
			'rol' => 'oficial de seguridad - empleado',
			)
	);
    public $pass=111111;
    private $arrayUsers = 
    array(
        array(
            'name' => 'a',
            'email' => 'a@a.c',
            'password' => '$2y$10$bsZ1EpQwakjKIPlXUEbQwe.x2MusZu5jjgvo7yy80IdyPaH9tIBey',
            'id_rol' => '0'
            )
    );

/*
formato para vector de carga de datos
	private $arrayRoles = 
    array(
		array(
			'colum' => 'conte',
			),
		array(
			'colum' => 'conte',
			)
	);
*/
}
