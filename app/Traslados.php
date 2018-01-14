<?php

namespace sisVentas;

use Illuminate\Database\Eloquent\Model;

class Traslados extends Model
{
    protected $table='traslados';

    protected $primaryKey='idtraslado';

    public $timestamps=false;

    protected $fillable =[
    	'idempleados',
        'fecha_hora',
    	'observacion',
    	'total',
    	'estado'
    ];
    protected $guarded =[
    ];
}
