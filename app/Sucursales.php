<?php
namespace sisVentas;
use Illuminate\Database\Eloquent\Model;

class Sucursales extends Model
{
    protected $table='sucursales';

    protected $primaryKey='idsucursal';

    public $timestamps=false;


    protected $fillable =[
    	'nombre',
    	'direccion',
    	'telefono',
    	'estado'
    ];

    protected $guarded =[

    ];

}
