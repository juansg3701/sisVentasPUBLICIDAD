<?php

namespace sisVentas;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'cliente';
    protected $primaryKey='id_cliente';
    public $timestamps =false;
    
    protected $fillable=['nombre', 'direccion', 'telefono','tipo_cargo_id_cargo','documento','verificacion_nit','sede_id_sede','empresa_id_empresa','user_id_user','empleado_id_empleado','fecha'];
    protected $guarded=[];
}

