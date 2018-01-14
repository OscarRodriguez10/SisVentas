<?php

namespace sisVentas;

use Illuminate\Database\Eloquent\Model;

class Empleados extends Model
{
    protected $table='empleados';

    protected $primaryKey='idempleado';

    public $timestamps=false;


    protected $fillable =[
    	'nombre',
    	'dpi',
    	'direccion',
        'telefono',
        'puesto',
        'idsucursal',
        'fechainicio',
        'fechafinal',
        'estado'
    
    ];

    protected $guarded =[

    ];

}
