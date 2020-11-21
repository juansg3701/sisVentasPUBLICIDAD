<?php

namespace sisVentas;

use Illuminate\Database\Eloquent\Model;

class EmpresaCategoria extends Model
{
    protected $table = 'empresa_categoria';
    protected $primaryKey='id_empresa_categoria';
    public $timestamps =false;
    
    protected $fillable=['nombre','descripcion','empresa_id_empresa','fecha_registro','empleado_id_empleado','sede_id_sede'];
    protected $guarded=[];
}
