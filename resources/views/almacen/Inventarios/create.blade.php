@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
	<h3>Nuevo Articulo al Inventario</h3>
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
			{!!Form::open(array('url'=>'almacen/inventarios','method'=>'POST','autocomplete'=>'off','files'=>'true'))!!}
            {{Form::token()}}
    <div class="panel panel-primary">
            <div class="panel-body">
                
                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                 <div class="form-group">
                    <label>Artículo</label>
                    
                    <select name="pidarticulo" class="form-control selectpicker" id="pidarticulo" data-live-search="true">
                    
                    @foreach($articulos as $art)
                    <option  value="{{$art->idarticulo}}_{{$art->precio_venta}}_{{$art->preciocosto}}_{{$art->nombre}}">{{$art->articulos}}  </option>
                     @endforeach
                        </select>
                    </div>
                </div>

            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                 <div class="form-group">
                    <label>Sucursales</label>
                    
                    <select name="pidsucursal" class="form-control selectpicker" id="pidsucursal" data-live-search="true">
                    
                    @foreach($sucursales as $suc)
                    <option  value="{{$suc->idsucursal}}_{{$suc->nombre}}"> {{$suc->nombre}}  </option>
                     @endforeach
                        </select>   
                    </div>
                </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="cantidad">Cantidad</label>
                <input type="number" name="pcantidad" id="pcantidad" class="form-control" placeholder="Cantidad...">
            </div>
        </div>        

        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="descripcion">Descripcion</label>
                <input type="float" name="pdescripcion" id="pdescripcion" class="form-control" placeholder="Descripcion...">
            </div>
        </div> 
    	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    		<div class="form-group">
            	<label for="preciocosto">PrecioCosto</label>
            	<input type="float" name="pprecio_costo" id="pprecio_costo" class= "form-control" placeholder="Preciocosto del articulo...">
            </div>
    	</div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="precioventa">PrecioVenta</label>
                <input type="float" name="pprecio_venta" id="pprecio_venta" class= "form-control" placeholder="PrecioVenta del articulo...">
            </div>
        </div>

            	
        
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label>Estado</label>
                <select name="estado" class="form-control">
                       <option value="Activo">Activo</option>
                       <option value="Inactivo">Inactivo</option>
                       
                </select>
            </div>
        </div>
        

        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    		<div class="form-group">
            	<button class="btn btn-primary" type="submit">Guardar</button>
            	<button class="btn btn-danger" type="reset">Cancelar</button>
            </div>
    	</div>
    </div>
    </div>        
            
            

{!!Form::close()!!}
@push ('scripts')
<script src="{{asset('js/JsBarcode.all.min.js')}}"></script>
<script src="{{asset('js/jquery.PrintArea.js')}}"></script>
<script>

$('#liAlmacen').addClass("treeview active");
$('#liInventarios').addClass("active");

 $("#pidarticulo").change(mostrarValores);
  $("#pidsucursal").change(mostrarclientes);


 function mostrarValores()
  {
    datosArticulo=document.getElementById('pidarticulo').value.split('_');
    $("#pprecio_venta").val(datosArticulo[1]);
    $("#pprecio_costo").val(datosArticulo[2]);
    $("#pdescripcion").val(datosArticulo[3]);
    $("#pidarticulo2").val(datosArticulo[0]);
        
  }
</script>
@endpush

@endsection