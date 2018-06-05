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

        self::seedGrupo_recibo();
        $this->command->info('Tabla de Grupo de Recibos inicializada con datos!');

        self::seedEstado_recibo();
        $this->command->info('Tabla de Estado de Recibos inicializada con datos!');

        self::seedPeriodo();
        $this->command->info('Tabla de Periodos inicializada con datos!');

        self::seedImportacion();
        $this->command->info('Tabla de Importaciones inicializada con datos!');

        self::seedPersona();
        $this->command->info('Tabla de Personas inicializada con datos!');
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
        $p = new User;
        $p->name = $users['name'];
        $p->email = $users['email'];
        $p->password = $users['password'];
        $p->id_rol = $users['id_rol'];
        $p->save();
        }
    }
        private function seedGrupo_recibo()
    {
    	DB::table('grupos_recibos')->delete();

        foreach( $this->arrayGrupos_recibos as $grupos_recibos) 
        {
        $p = new Grupo_recibo;
        $p->id_grupo = $grupos_recibos['id_grupo'];
        $p->nombre_grupo = $grupos_recibos['nombre_grupo'];
        $p->ene = $grupos_recibos['ene'];
        $p->feb = $grupos_recibos['feb'];
        $p->mar = $grupos_recibos['mar'];
        $p->abr = $grupos_recibos['abr'];
        $p->may = $grupos_recibos['may'];
        $p->jun = $grupos_recibos['jun'];
        $p->jul = $grupos_recibos['jul'];
        $p->ago = $grupos_recibos['ago'];
        $p->set = $grupos_recibos['set'];
        $p->oct = $grupos_recibos['oct'];
        $p->nov = $grupos_recibos['nov'];
        $p->dic = $grupos_recibos['dic'];
        $p->save();
        }
    }
        private function seedEstado_recibo()
    {
    	DB::table('estado_recibos')->delete();

        foreach( $this->arrayEstado_recibos as $estado_recibos) 
        {
        $p = new Estado_Recibo;
        $p->ubicacion_recibo = $estado_recibos['ubicacion_recibo'];
        $p->estado = $estado_recibos['estado'];
        $p->save();
        }
    }
        private function seedPeriodo()
    {
    	DB::table('periodos')->delete();

        foreach( $this->arrayPeriodos as $periodos) 
        {
        $p = new Periodo;
        $p->estado_periodo = $periodos['estado_periodo'];
        $p->fecha = $periodos['fecha'];
        $p->save();
        }
    }
        private function seedImportacion()
    {
    	DB::table('importaciones')->delete();

        foreach( $this->arrayImportaciones as $importaciones) 
        {
        $p = new Importacion;
        $p->id_importacion = $importaciones['id_importacion'];
        $p->id_periodo = $importaciones['id_periodo'];
        $p->total_rec = $importaciones['total_rec'];
        $p->emp_sin_rec = $importaciones['emp_sin_rec'];
        $p->rec_sin_emp = $importaciones['rec_sin_emp'];
        $p->rec_con_err = $importaciones['rec_con_err'];
        $p->save();
        }
    }
        private function seedPersona()
    {
    	DB::table('personas')->delete();

        foreach( $this->arrayPersonas as $personas) 
        {
        $p = new Persona;
        $p->cedula = $personas['cedula'];
        $p->id_usuario = $personas['id_usuario'];
        $p->id_grupo = $personas['id_grupo'];
        $p->nombres = $personas['nombres'];
        $p->apellidos = $personas['apellidos'];
        $p->tel = $personas['tel'];
        $p->cel = $personas['cel'];
        $p->dpto = $personas['dpto'];
        $p->cargo = $personas['cargo'];
        $p->correo = $personas['correo'];
        $p->estado = $personas['estado'];
        $p->obs = $personas['obs'];
        $p->save();
        }
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
			'rol' => 'sin rol'
			),
		array(
			'id_rol' => 1,
			'rol' => 'empleado'
			),
		array(
			'id_rol' => 2,
			'rol' => 'rrhh - empleado'
			),
		array(
			'id_rol' => 3,
			'rol' => 'empresa 0'
			),
		array(
			'id_rol' => 4,
			'rol' => 'empresa 1'
			),
		array(
			'id_rol' => 5,
			'rol' => 'empresa 1 - empleado'
			),
		array(
			'id_rol' => 6,
			'rol' => 'oficial de seguridad - empleado'
			)
	);

    private $arrayUsers = 
    array(
        array(
            'name' => 'AAAA',
            'email' => 'a@a.c',
            'password' => '$2y$10$bsZ1EpQwakjKIPlXUEbQwe.x2MusZu5jjgvo7yy80IdyPaH9tIBey',
            'id_rol' => '3'
            ),
        array(
            'name' => 'BBBB',
            'email' => 'b@b.c',
            'password' => '$2y$10$bsZ1EpQwakjKIPlXUEbQwe.x2MusZu5jjgvo7yy80IdyPaH9tIBey',
            'id_rol' => '2'
            ),
        array(
            'name' => 'CCCC',
            'email' => 'c@c.c',
            'password' => '$2y$10$bsZ1EpQwakjKIPlXUEbQwe.x2MusZu5jjgvo7yy80IdyPaH9tIBey',
            'id_rol' => '6'
            ),
        array(
            'name' => 'DDDD',
            'email' => 'd@d.c',
            'password' => '$2y$10$bsZ1EpQwakjKIPlXUEbQwe.x2MusZu5jjgvo7yy80IdyPaH9tIBey',
            'id_rol' => '1'
            ),
        array(
            'name' => 'EEEE',
            'email' => 'e@e.c',
            'password' => '$2y$10$bsZ1EpQwakjKIPlXUEbQwe.x2MusZu5jjgvo7yy80IdyPaH9tIBey',
            'id_rol' => '1'
            ),
        array(
            'name' => 'FFFF',
            'email' => 'f@f.c',
            'password' => '$2y$10$bsZ1EpQwakjKIPlXUEbQwe.x2MusZu5jjgvo7yy80IdyPaH9tIBey',
            'id_rol' => '1'
            )
    );
    private $arrayGrupos_recibos = 
    array(
        array(
            'id_grupo' => '1',
            'nombre_grupo' => 'predeterminado',
            'ene' => '1',
            'feb' => '1',
            'mar' => '1',
            'abr' => '1',
            'may' => '1',
            'jun' => '1',
            'jul' => '1',
            'ago' => '1',
            'set' => '1',
            'oct' => '1',
            'nov' => '1',
            'dic' => '2'
            ),

        array(
            'id_grupo' => '2',
            'nombre_grupo' => 'vendedores',
            'ene' => '2',
            'feb' => '2',
            'mar' => '2',
            'abr' => '2',
            'may' => '2',
            'jun' => '2',
            'jul' => '2',
            'ago' => '2',
            'set' => '2',
            'oct' => '2',
            'nov' => '2',
            'dic' => '2'
            )
    );
    private $arrayEstado_recibos = 
    array(
        array(
            'id_estado_recibo' => '1',
            'ubicacion_recibo' => 'c:/recibos/nuevos',
            'estado' => 'nuevo'
            ),
        array(
            'id_estado_recibo' => '2',
            'ubicacion_recibo' => 'c:/recibos/pendientes',
            'estado' => 'pendiente'
            ),
        array(
            'id_estado_recibo' => '3',
            'ubicacion_recibo' => 'c:/recibos/firmados_empresa',
            'estado' => 'firmado_empresa'
            ),
        array(
            'id_estado_recibo' => '4',
            'ubicacion_recibo' => 'c:/recibos/firmados_empresa_empleados',
            'estado' => 'firmado_empresa_empleado'
            )
        
    );
    private $arrayPeriodos = 
    array(
        array(
            'estado_periodo' => '1',
            'fecha' => '2018-01-01'
            ),
        array(
            'estado_periodo' => '0',
            'fecha' => '2018-02-01'
            ),
        array(
            'estado_periodo' => '0',
            'fecha' => '2018-03-01'
            )
    );
    private $arrayImportaciones = 
    array(
        array(
            'id_importacion' => '1',
            'id_periodo' => '1',
            'total_rec' => '5',
            'emp_sin_rec' => '0',
            'rec_sin_emp' => '0',
            'rec_con_err' => '0'
            ),
        array(
            'id_importacion' => '2',
            'id_periodo' => '2',
            'total_rec' => '4',
            'emp_sin_rec' => '1',
            'rec_sin_emp' => '0',
            'rec_con_err' => '0'
            ),
        array(
            'id_importacion' => '3',
            'id_periodo' => '3',
            'total_rec' => '3',
            'emp_sin_rec' => '2',
            'rec_sin_emp' => '0',
            'rec_con_err' => '0'
            )
    );
    private $arrayPersonas = 
    array(
        array(
            'cedula' => '0000000',
            'id_usuario' => '0',
            'id_grupo' => '1',
            'nombres' => 'AAAA',
            'apellidos' => 'AAAA',
            'tel' => '123',
            'cel' => '999',
            'dpto' => 'dpto',
            'cargo' => 'cargo',
            'correo' => 'a@a.c',
            'estado' => '1',
            'obs' => 'ninguna'
            ),
        array(
            'cedula' => '1111111',
            'id_usuario' => '1',
            'id_grupo' => '1',
            'nombres' => 'BBBB',
            'apellidos' => 'BBBB',
            'tel' => '123',
            'cel' => '999',
            'dpto' => 'dpto',
            'cargo' => 'cargo',
            'correo' => 'b@b.c',
            'estado' => '1',
            'obs' => 'ninguna'
            ),
        array(
            'cedula' => '2222222',
            'id_usuario' => '2',
            'id_grupo' => '1',
            'nombres' => 'CCCC',
            'apellidos' => 'CCCC',
            'tel' => '123',
            'cel' => '999',
            'dpto' => 'dpto',
            'cargo' => 'cargo',
            'correo' => 'c@c.c',
            'estado' => '1',
            'obs' => 'ninguna'
            ),
        array(
            'cedula' => '3333333',
            'id_usuario' => '3',
            'id_grupo' => '1',
            'nombres' => 'DDDD',
            'apellidos' => 'DDDD',
            'tel' => '123',
            'cel' => '999',
            'dpto' => 'dpto',
            'cargo' => 'cargo',
            'correo' => 'd@d.c',
            'estado' => '1',
            'obs' => 'ninguna'
            ),
        array(
            'cedula' => '4444444',
            'id_usuario' => '4',
            'id_grupo' => '2',
            'nombres' => 'EEEE',
            'apellidos' => 'EEEE',
            'tel' => '123',
            'cel' => '999',
            'dpto' => 'dpto',
            'cargo' => 'cargo',
            'correo' => 'e@e.c',
            'estado' => '1',
            'obs' => 'ninguna'
            ),
        array(
            'cedula' => '5555555',
            'id_usuario' => '5',
            'id_grupo' => '2',
            'nombres' => 'FFFF',
            'apellidos' => 'FFFF',
            'tel' => '123',
            'cel' => '999',
            'dpto' => 'dpto',
            'cargo' => 'cargo',
            'correo' => 'f@f.c',
            'estado' => '1',
            'obs' => 'ninguna'
            )
    );
/*
formato para vector de carga de datos semilla
	private $arrayRoles = 
    array(
		array(
			'colum_tabla1' => 'dato',
            'colum_tabla2' => 'dato'
			),
		array(
			'colum1' => 'dato'
			)
	);
*/
}
