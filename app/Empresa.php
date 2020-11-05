<?php

namespace sisVentas;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $table = 'empresa';
    protected $primaryKey='id_empresa';
    public $timestamps =false;
    
    protected $fillable=['nombre', 'descripcion'];
    protected $guarded=[];
}

