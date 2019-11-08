<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recibo_con_error extends Model
{
    protected $table = 'recibos_con_errores';
    protected $primaryKey = 'id';
    public $timestamps = false;
}
