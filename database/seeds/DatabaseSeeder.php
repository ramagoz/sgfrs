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

        self::seedEmpleado_sin_recibo();
        $this->command->info('Tabla de Empleados sin recibos inicializada con datos!');

        self::seedRecibo();
        $this->command->info('Tabla de Recibos inicializada con datos!');

        self::seedAuditoria();
        $this->command->info('Tabla de Auditoria inicializada con datos!');

        self::seedFirma_empresa();
        $this->command->info('Tabla de Firma Empresa inicializada con datos!');
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
        $p->mes = $periodos['mes'];
        $p->año = $periodos['año'];
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

        foreach( $this->arrayEmpleados_sin_recibos as $empleados_sin_recibos) 
        {
        $p = new Empleado_sin_recibo;
        $p->id_emp_sin_rec = $empleados_sin_recibos['id_emp_sin_rec'];
        $p->cedula = $empleados_sin_recibos['cedula'];
        $p->id_periodo = $empleados_sin_recibos['id_periodo'];
        $p->save();
        }
    }
        private function seedRecibo()
    {
    	DB::table('recibos')->delete();

        foreach( $this->arrayRecibos as $recibos) 
        {
        $p = new Recibo;
        $p->id_recibo = $recibos['id_recibo'];
        $p->id_estado_recibo = $recibos['id_estado_recibo'];
        $p->cedula = $recibos['cedula'];
        $p->id_periodo = $recibos['id_periodo'];
        $p->save();
        }
    }
        private function seedAuditoria()
    {
    	DB::table('auditorias')->delete();

        foreach( $this->arrayAuditorias as $auditorias) 
        {
        $p = new Auditoria;
        $p->cedula = $auditorias['cedula'];
        $p->tipo_operacion = $auditorias['tipo_operacion'];
        $p->descripcion = $auditorias['descripcion'];
        $p->fecha_hora = $auditorias['fecha_hora'];
        $p->save();
        }
    }
        private function seedFirma_empresa()
    {
    	DB::table('firma_empresas')->delete();

        foreach( $this->arrayFirma_empresas as $firma_empresas) 
        {
        $p = new Firma_empresa;
        $p->cedula = $firma_empresas['cedula'];
        $p->id_recibo = $firma_empresas['id_recibo'];
        $p->save();
        }
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
			'rol' => 'empresa 1 - empleado'
			),
		array(
			'id_rol' => 5,
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
            'id_rol' => '5'
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
            'mes' => '01',
            'año' => '2018'
            ),
        array(
            'estado_periodo' => '0',
            'mes' => '02',
            'año' => '2018'
            ),
        array(
            'estado_periodo' => '0',
            'mes' => '03',
            'año' => '2018'
            ),
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
    private $arrayEmpleados_sin_recibos = 
    array(
        array(
            'id_emp_sin_rec' => '1',
            'cedula' => '1111111',
            'id_periodo' => '2'
            ),
        array(
            'id_emp_sin_rec' => '2',
            'cedula' => '2222222',
            'id_periodo' => '3'
            ),
        array(
            'id_emp_sin_rec' => '3',
            'cedula' => '1111111',
            'id_periodo' => '3'
            )
    );
    private $arrayRecibos = 
    array(
        array(
            'id_recibo' => '1111111-0118',
            'id_estado_recibo' => '4',
            'cedula' => '1111111',
            'id_periodo' => '1'
            ),
        array(
            'id_recibo' => '2222222-0118',
            'id_estado_recibo' => '4',
            'cedula' => '2222222',
            'id_periodo' => '1'
            ),
        array(
            'id_recibo' => '3333333-0118',
            'id_estado_recibo' => '4',
            'cedula' => '3333333',
            'id_periodo' => '1'
            ),
        array(
            'id_recibo' => '4444444-0118',
            'id_estado_recibo' => '4',
            'cedula' => '4444444',
            'id_periodo' => '1'
            ),
        array(
            'id_recibo' => '5555555-0118',
            'id_estado_recibo' => '4',
            'cedula' => '5555555',
            'id_periodo' => '1'
            ),
        array(
            'id_recibo' => '2222222-0218',
            'id_estado_recibo' => '4',
            'cedula' => '2222222',
            'id_periodo' => '2'
            ),
        array(
            'id_recibo' => '3333333-0218',
            'id_estado_recibo' => '4',
            'cedula' => '3333333',
            'id_periodo' => '2'
            ),
        array(
            'id_recibo' => '4444444-0218',
            'id_estado_recibo' => '4',
            'cedula' => '4444444',
            'id_periodo' => '2'
            ),
        array(
            'id_recibo' => '5555555-0218',
            'id_estado_recibo' => '4',
            'cedula' => '5555555',
            'id_periodo' => '2'
            ),
        array(
            'id_recibo' => '3333333-0318',
            'id_estado_recibo' => '4',
            'cedula' => '3333333',
            'id_periodo' => '3'
            ),
        array(
            'id_recibo' => '4444444-0318',
            'id_estado_recibo' => '4',
            'cedula' => '4444444',
            'id_periodo' => '3'
            ),
        array(
            'id_recibo' => '5555555-0318',
            'id_estado_recibo' => '4',
            'cedula' => '5555555',
            'id_periodo' => '3'
            )
    );
    private $arrayAuditorias = 
    array(
        array(
            'cedula' => '0000000',
            'tipo_operacion' => 'firma',
            'descripcion' => 'firma recibo empleado ci 2222222',
            'fecha_hora' => '2018-01-01'
            ),
        array(
            'cedula' => '0000000',
            'tipo_operacion' => 'firma',
            'descripcion' => 'firma recibo empleado ci 3333333',
            'fecha_hora' => '2018-01-01'
            )
        
    );
    private $arrayFirma_empresas = 
    array(
        array(
            'cedula' => '0000000',
            'id_recibo' => 'recibo-1111111-0118'
            ),
        array(
            'cedula' => '0000000',
            'id_recibo' => 'recibo-2222222-0118'
            ),
        array(
            'cedula' => '0000000',
            'id_recibo' => 'recibo-33333333-0118'
            ),
        array(
            'cedula' => '0000000',
            'id_recibo' => 'recibo-4444444-0118'
            ),
        array(
            'cedula' => '0000000',
            'id_recibo' => 'recibo-5555555-0118'
            ),
        array(
            'cedula' => '0000000',
            'id_recibo' => 'recibo-2222222-0218'
            ),
        array(
            'cedula' => '0000000',
            'id_recibo' => 'recibo-3333333-0218'
            ),
        array(
            'cedula' => '0000000',
            'id_recibo' => 'recibo-4444444-0218'
            ),
        array(
            'cedula' => '0000000',
            'id_recibo' => 'recibo-5555555-0218'
            ),
        array(
            'cedula' => '0000000',
            'id_recibo' => 'recibo-3333333-0318'
            ),
        array(
            'cedula' => '0000000',
            'id_recibo' => 'recibo-4444444-0318'
            ),
        array(
            'cedula' => '0000000',
            'id_recibo' => 'recibo-5555555-0318'
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
