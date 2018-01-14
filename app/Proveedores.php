<?php

namespace sisVentas;

use Illuminate\Database\Eloquent\Model;

class Proveedores extends Model
{
    
    protected $table='proveedores';

    protected $primaryKey='idproveedor';
    public $timestamps=false;


    protected $fillable =[
    	'nombre',
    	'nombre_contacto',
    	'direccion',
    	'telefono',
        'politica',
        'email',
        'nombre_cuenta',
        'no_cuenta',
        'opcion_compra',
        'estado'
    ];

    protected $guarded =[

    ];
}

