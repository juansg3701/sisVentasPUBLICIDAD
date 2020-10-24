<?php

namespace sisVentas;

use Illuminate\Database\Eloquent\Model;

class CategoriaStock extends Model
{
    protected $table = 'categoria_stock_especiales';
    protected $primaryKey='id_categoriaStock';
    public $timestamps =false;
    
    protected $fillable=['nombre','descripcion','fecha','empleado_id_empleado','sede_id_sede'];
    protected $guarded=[];
}