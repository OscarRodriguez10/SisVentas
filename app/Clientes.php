<?php

namespace sisVentas;
use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{
    protected $table='clientes';

    protected $primaryKey='idcliente';

    public $timestamps=false;


    protected $fillable =[
    	'nombre',
    	'direccion',
    	'telefono',
    	'nit',
        'email',
        'estado'
    	
    ];

    protected $guarded =[

    ];
}
