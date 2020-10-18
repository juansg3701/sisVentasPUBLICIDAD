<?php

namespace sisVentas;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'empleado';
    protected $primaryKey='id_empleado';
    public $timestamps =false;
    
  protected $fillable=['user_id_user','nombre', 'correo','tipo_cargo_id_cargo', 'sede_id_sede', 'codigo','telefono','direccion','fecha'];
    protected $guarded=[];
}
