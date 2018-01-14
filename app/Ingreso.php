<?php

namespace sisVentas;

use Illuminate\Database\Eloquent\Model;

class Ingreso extends Model
{
    protected $table='ingreso';

    protected $primaryKey='idingreso';

    public $timestamps=false;

    protected $fillable =[
    	'idproveedor',
    	'serie_factura',
    	'num_factura',
    	'fecha_hora',
        'idempleado',
    	'estado'
    ];
    protected $guarded =[
    ];
}
