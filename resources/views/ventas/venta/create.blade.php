@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Nueva Venta</h3>
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
			{!!Form::open(array('url'=>'ventas/venta','method'=>'POST','autocomplete'=>'off'))!!}
            {{Form::token()}}
    
    <div class="row">
         <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
                    <div class="form-group">
                        <input type="number" name="pidsucursal" id="pidsucursal" value="{{ Auth::user()->idsucursal}}" class="form-control" 
                        placeholder="Idsucural.." style="visibility:hidden">
                    </div>
                </div>    
               
        <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
                    <div class="form-group">
                        
                        <input type="number" name="pidempleado" id="pidempleado" value="{{ Auth::user()->idempleado}}" class="form-control" 
                        placeholder="Idempleado.." style="visibility:hidden">
                    </div>
                </div>    
               


                    
              
    </div>

    <div class="row">
        
        
                <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                 <div class="form-group">
                    <label>Cliente</label>
                    
                    <select name="pidcliente" class="form-control selectpicker" id="pidcliente" data-live-search="true">
                    
                    @foreach($clientes as $cli)
                    <option  value="{{$cli->idcliente}}_{{$cli->nombre}}"> {{$cli->nombre}}  </option>
                     @endforeach
                        </select>
                    </div>
                </div>
            
        <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
                    <div class="form-group">
                        <label for="nit">Nit</label>
                        <input type="text" name="pnit" id="pnit" class="form-control" 
                        placeholder="Nit..">
                    </div>
                </div>
                <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                    <div class="form-group">
                        <label for="direccion">Direccion</label>
                        <input type="text" name="pdireccion" id="pdireccion"    class="form-control" 
                        placeholder="Direccion...">
                    </div>
                </div>
    	
         <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
            <div class="form-group">
                <label for="fecha_hora">Fecha</label>
                <input type="text" id="fecha_hora" name="fecha_hora" class="form-control"  value="<?php echo date("m/d/Y"); ?>" required/> 
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
                    <option  value="{{$inv->idarticulo}}_{{$inv->cantidad}}_{{$inv->precio_venta}}_{{$inv->preciocosto}}">{{$inv->inventarios}}  </option>
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
                        <label for="cantidad">Stock</label>
                        <input type="number"  disabled name="pcantidad" id="pcantidad" class="form-control" 
                        placeholder="Stock">
                    </div>
                </div>
                <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
                    <div class="form-group">
                        <label for="precio_venta">Precio venta</label>
                        <input type="number" disabled name="pprecio_venta" id="pprecio_venta" class="form-control" 
                        placeholder="P. venta">
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
                            <th>P Venta</th>
                            <th>|</th>
                            <th>Sub Venta</th>
                            
                        </thead>
                        <tfoot>
                            <tr>
                                <th  colspan="5"><p align="right">TOTAL:</p></th>
                                <th><p align="right"><span id="total">Q/. 0.00</span> <input type="hidden" name="total_venta" id="total_venta"></p></th>
                            </tr>
                            
                            <tr>
                                <th  colspan="5"><p align="right">TOTAL PAGAR:</p></th>
                                <th><p align="right"><span align="right" id="total_pagar">Q/.   0.00</span></p></th>
                            </tr> 
                            <tr>
                                <th><p align="right"><span style="visibility:hidden" id="total2">Q/. 0.00</span> <input type="hidden" style="visibility:hidden" name="total_costo" id="total_costo"></p></th>
                            </tr>
                            <tr>
                                <th><p align="right"><span style="visibility:hidden" id="ganancia">Q/. 0.00</span> <input type="hidden" style="visibility:hidden" name="ganancia" id="ganancia"></p></th>
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
  $("#pidcliente").change(mostrarclientes);


 function mostrarValores()
  {
    datosArticulo=document.getElementById('pidarticulo').value.split('_');
    $("#pprecio_venta").val(datosArticulo[2]);
    $("#pcantidad").val(datosArticulo[1]);
    $("#pprecio_costo").val(datosArticulo[3]);    
  }
  function mostrarclientes()
  {
    datosArticulo2=document.getElementById('pidcliente').value.split('_');
    $("#pnit").String(datosArticulo2[2]);
    $("#pdireccion").String(datosArticulo2[1]);    
  }


function agregar()
  {
    datosArticulo=document.getElementById('pidarticulo').value.split('_');

    idarticulo=datosArticulo[0];
    articulo=$("#pidarticulo option:selected").text();
    cantidad=$("#pcantidad2").val();
    idsucursal=$("#pidsucursal").val();


     
    precio_venta=$("#pprecio_venta").val();
    precio_costo=$("#pprecio_costo").val();
    stock=$("#pcantidad").val();
    

    if (idarticulo!="" && cantidad!="" && cantidad>0  && precio_venta!="")
    {
        if (parseInt(stock)>=parseInt(cantidad))
        {

        subtotal[cont]=(cantidad*precio_venta);
        total=total+subtotal[cont];

        subtotal2[cont]=(cantidad*precio_costo);
        
        total2=total2+subtotal2[cont];
        
        subganancia[cont] =   (subtotal[cont] -  subtotal2[cont]);        
        ganancia = (total-total2);
        
       
        var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+');">X</button></td><td><input type="hidden" name="idarticulo[]" value="'+idarticulo+'">'+articulo+'</td><td><input type="number"  name="cantidad[]" value="'+cantidad+'"></td><td><input  type="number"   name="precio_venta[]"   value="'+parseFloat(precio_venta).toFixed(2)+'"></td><td><input type="number"   name="precio_venta[]" style="visibility:hidden"  value="'+parseFloat(precio_costo).toFixed(2)+'"></td><td align="right">Q/. '+parseFloat(subtotal[cont]).toFixed(2)+'</td>  <td><input type="number"  name="idsucursal[]" value="'+idsucursal+'" style="visibility:hidden"></tr>';
        cont++;
        limpiar();
        totales();
        evaluar();
        $('#detalles').append(fila);   
        }
        else
        {
            alert ('La cantidad a vender supera el stock');
        }
        
    }
    else
    {
        alert("Error al ingresar el detalle de la venta, revise los datos del artículo");
    }
  }
  function limpiar(){
    $("#pcantidad2").val("");
    $("#pcantidad").val("");
    $("#pprecio_venta").val("");
    $("#pprecio_costo").val("");
  }
  function totales()
  {
        $("#total").html("Q/. " + total.toFixed(2));
        $("#total_venta").val(total.toFixed(2));
        
        $("#total2").html("Q/. " + total2.toFixed(2));
        $("#total_costo").val(total2.toFixed(2));

        $("#ganancia").html("Q/. " + ganancia.toFixed(2));
        $("#ganancia").val(ganancia.toFixed(2));
        
      
       
        total_pagar=total;
        $("#total_pagar").html("Q/. " + total_pagar.toFixed(2));
        
  }
  
  function evaluar()
  {
    if (total>0)
    {
      $("#guardar").show();
    }
    else
    {
      $("#guardar").hide(); 
    }
  }

   function eliminar(index){
    total=total-subtotal[index]; 
    total2=total2-subtotal2[index]; 
    ganancia=ganancia-subganancia[index]; 
    totales();  
    $("#fila" + index).remove();
    evaluar();

  }
$('#liVentas').addClass("treeview active");
$('#liVentass').addClass("active");
  
</script>
@endpush
@endsection