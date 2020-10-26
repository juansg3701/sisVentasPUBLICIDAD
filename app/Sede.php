<?php

namespace sisVentas;

use Illuminate\Database\Eloquent\Model;

class Sede extends Model
{
    protected $table = 'sede';
    protected $primaryKey='id_sede';
    public $timestamps =false;
    
    protected $fillable=['nombre_sede', 'ciudad', 'descripcion', 'direccion', 'telefono','empleado_id_empleado','fecha','tipo_sede_id_tipo_sede'];
    protected $guarded=[];
}

