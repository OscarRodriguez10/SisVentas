@extends ('layouts.admin')
@section ('contenido')
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <h3>Nueva Compra</h3>
            @if (count($errors)>0)
            <div class="alert alert-danger">
                <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
                </ul>
            </div>
            @endif
        </div>
    </div>
            {!!Form::open(array('url'=>'compras/ingreso','method'=>'POST','autocomplete'=>'off'))!!}
            {{Form::token()}}
    <div class="row">
                
        <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
                    <div class="form-group">
                        <input type="number" name="pidempleado" id="pidempleado" value="{{ Auth::user()->idempleado}}" class="form-control" 
                        placeholder="idmpleado.." style="visibility:hidden">
                    </div>
                </div>
   

    <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
                    <div class="form-group">
                        <input type="number" name="pidsucursal" id="pidsucursal" value="{{ Auth::user()->idsucursal}}" class="form-control" 
                        placeholder="Sucursal.." style="visibility:hidden">
                    </div>
                </div>
    </div>

    
    



    <div class="row">
        
                <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                 <div class="form-group">
                    <label>Proveedores</label>
                    
                    <select name="pidproveedor" class="form-control selectpicker" id="pidproveedor" data-live-search="true">
                    
                    @foreach($proveedores as $prov)
                    <option  value="{{$prov->idproveedor}}_{{$prov->nombre}}"> {{$prov->nombre}}  </option>
                     @endforeach
                        </select>
                    </div>
                </div>
            
        <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
                    <div class="form-group">
                        <label for="serie_factura">Serie_Factura</label>
                        <input type="text" name="pserie_factura" id="pserie_factura" class="form-control" 
                        placeholder="Serie_factura..">
                    </div>
                </div>
                <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
                    <div class="form-group">
                        <label for="num_factura">Num_factura</label>
                        <input type="text" name="pnum_factura" id="pdireccion"    class="form-control" 
                        placeholder="Direccion...">
                    </div>
                </div>
        
         <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
            <div class="form-group">
                <label for="fecha_hora">Fecha</label>
                <input type="text" id="fecha_hora"  name="fecha_hora" class="form-control" value="<?php echo date("Y-n-j"); ?>" required/> 
            </div>
        </div>
    </div>

<div class="row">
        <div class="panel panel-primary">
            <div class="panel-body">
                
                <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                 <div class="form-group">
                    <label>Artículo</label>
                    
                    <select name="pidarticulo" class="form-control selectpicker" id="pidarticulo" data-live-search="true">
                    
                    @foreach($inventarios as $inv)
                    <option  value="{{$inv->idarticulo}}_{{$inv->cantidad}}_{{$inv->precio_costo}}">{{$inv->inventarios}}  </option>
                     @endforeach
                        </select>
                    </div>
                </div>
            
                <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
                    <div class="form-group">
                        <label for="cantidad2">Cantidad</label>
                        <input type="number" name="pcantidad2" id="pcantidad2" class="form-control" 
                        placeholder="cantidad">
                    </div>
                </div>
                <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
                    <div class="form-group">
                        <label for="precio_costo">PrecioCosto</label>
                        <input type="number" name="pprecio_costo" id="pprecio_costo" class="form-control" 
                        placeholder="P. Costo">
                    </div>
                </div>


                <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
                    <div class="form-group">
                       <button type="button" id="bt_add" class="btn btn-primary">Agregar</button>
                    </div>
                </div> 


    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
    <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
        <thead style="background-color:#A9D0F5">
                            
                            <th>Opciones</th>
                            <th>Artículo</th>
                            <th>Cantidad</th>
                            <th>P Costo</th>
                            <th>sub Costo</th>
                            
                        </thead>
                        <tfoot>
                            <tr>
                                <th  colspan="5"><p align="right">TOTAL:</p></th>
                                <th><p align="right"><span id="total2">Q/. 0.00</span> <input type="hidden" name="total_costo" id="total_costo"></p></th>
                            </tr>
                            
                            
 
                        </tfoot>
                        
                        <tbody>
                            
                        </tbody>
                    </table>
                 </div>
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12" id="guardar">
            <div class="form-group">
                <input name"_token" value="{{ csrf_token() }}" type="hidden"></input>
                <button class="btn btn-primary" type="submit">Guardar</button>
                <button class="btn btn-danger" type="reset">Cancelar</button>
            </div>
        </div>
    </div>   

{!!Form::close()!!} 
@push ('scripts')

<script>
  $(document).ready(function(){
    $('#bt_add').click(function(){
      agregar();

    });
  });

  var cont=0;
  total=0;
  subtotal=[];
  ganancia=0;
  subganancia=[];
  total2=0;
  subtotal2=[];
  
  $("#guardar").hide();
  $("#pidarticulo").change(mostrarValores);
  

 function mostrarValores()
  {
    datosArticulo=document.getElementById('pidarticulo').value.split('_');
    $("#pprecio_costo").val(datosArticulo[2]);    
    $("#pcantidad").val(datosArticulo[1]);
  }  
  


function agregar()
  {
    datosArticulo=document.getElementById('pidarticulo').value.split('_');

    idarticulo=datosArticulo[0];
    articulo=$("#pidarticulo option:selected").text();
    cantidad=$("#pcantidad2").val();
    idsucursal=$("#pidsucursal").val();

     
    precio_costo=$("#pprecio_costo").val();
    

    if (idarticulo!="" && precio_costo!="")
    {
       

        
        subtotal2[cont]=(cantidad*precio_costo);
        
        total2=total2+subtotal2[cont];
        
        
       
        var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+');">X</button></td><td><input type="hidden" name="idarticulo[]" value="'+idarticulo+'">'+articulo+'</td><td><input type="number"  name="cantidad[]" value="'+cantidad+'"></td><td><input type="number"  name="precio_costo[]" value="'+parseFloat(precio_costo).toFixed(2)+'"></td><td align="right">Q/. '+parseFloat(subtotal2[cont]).toFixed(2)+'</td><td><input type="number"  name="idsucursal[]" value="'+idsucursal+'" style="visibility:hidden"> </td></tr>';
        cont++;
        limpiar();
        totales();
        evaluar();
        $('#detalles').append(fila);   
        }
        else
        {
            alert ('La error intente de nuevo.');
        }
        
    }
    
  function limpiar(){
    $("#pcantidad").val("");
    $("#pprecio_costo").val("");
  }
  function totales()
  {
        
        $("#total2").html("Q/. " + total2.toFixed(2));
        $("#total_costo").val(total2.toFixed(2));

        
      
       
        //total_pagar=total;
        //$("#total_pagar").html("Q/. " + total_pagar.toFixed(2));
        
  }
  
  function evaluar()
  {
    if (total2>0)
    {
      $("#guardar").show();
    }
    else
    {
      $("#guardar").hide(); 
    }
  }

   function eliminar(index){
    total2=total2-subtotal2[index]; 
    totales();  
    $("#fila" + index).remove();
    evaluar();

  }
$('#liVentas').addClass("treeview active");
$('#liVentass').addClass("active");
  
</script>
@endpush
@endsection