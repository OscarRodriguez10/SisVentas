<?php

namespace sisVentas;

use Illuminate\Database\Eloquent\Model;

class DetalleTraslados extends Model
{
   
protected $table='detalle_traslados';

    protected $primaryKey='iddetalle_traslados';

    public $timestamps=false;

    protected $fillable =[
    	'idtraslado',
        'idarticulo',
    	'cantidad',
    	'precio_venta',
    	'subtotal',
        'suc_origen',
        'suc_destino'
    	
    ];
    protected $guarded =[
    ];
}
