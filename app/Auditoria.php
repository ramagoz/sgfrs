<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Auditoria extends Model
{
	 protected $table = 'auditorias';
     protected $primaryKey = 'id_auditoria';
     public $timestamps = false;
}
