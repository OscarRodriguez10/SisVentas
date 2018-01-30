<?php

namespace sisVentas;

use Illuminate\Database\Eloquent\Model;

class TipoUsuario extends Model
{
    protected $table='tipo_usuario';

    protected $primaryKey='idtipo';

    public $timestamps=false;

    protected $fillable =[
    	'descripcion',
    	'estado'
    	
    ];
    protected $guarded =[
    ];
}

