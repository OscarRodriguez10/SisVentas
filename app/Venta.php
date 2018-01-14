<?php

namespace sisVentas;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $table='venta';

    protected $primaryKey='idventa';

    public $timestamps=false;

    protected $fillable =[
    	'idcliente',
        'nit',
    	'direccion',
    	'fecha_hora',
    	'total_venta',
        'ganancia',
        'idempleado',
    	'estado'
    ];
    protected $guarded =[
    ];
}
