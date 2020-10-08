<?php

namespace sisVentas;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table = 'categoria';
    protected $primaryKey='id_categoria';
    public $timestamps =false;
    
    protected $fillable=['nombre','descripcion'];
    protected $guarded=[];
}