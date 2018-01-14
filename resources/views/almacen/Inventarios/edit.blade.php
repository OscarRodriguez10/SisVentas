@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Editar Artículo: {{ $articulo->nombre}}</h3>
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
			{!!Form::model($articulo,['method'=>'PATCH','route'=>['almacen.articulo.update',$articulo->idarticulo],'files'=>'true'])!!}
            {{Form::token()}}
    <div class="row">
    	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    		<div class="form-group">
            	<label for="nombre">Nombre</label>
            	<input type="text" name="nombre" required value="{{$articulo->nombre}}" class="form-control">
            </div>
    	</div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="codigo">Barra</label>
                <input type="text" name="codigo" required value="{{$articulo->codigo}}" class="form-control">
            </div>
        </div>

        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="formula">Formula</label>
                <input type="text" name="formula" required value="{{$articulo->formula}}" class="form-control">
            </div>
        </div>
        
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="preciocosto">PrecioCosto</label>
                <input type="float" name="preciocosto" required value="{{$articulo->preciocosto}}" class="form-control">
            </div>
        </div>
        
    	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="precioventa">PrecioVenta</label>
                <input type="float" name="precioventa" required value="{{$articulo->precioventa}}" class="form-control">
            </div>
        </div>
        
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="precioventa2">PrecioVenta2</label>
                <input type="float" name="precioventa2" required value="{{$articulo->precioventa}}" class="form-control">
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="bono">Bono</label>
                <input type="float" name="bono" required value="{{$articulo->bono}}" class="form-control">
            </div>
        </div>
        
        
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    		<div class="form-group">
    			<label>Categoría</label>
    			<select name="idcategoria" class="form-control">
    				@foreach ($categorias as $cat)
    					@if ($cat->idcategoria==$articulo->idcategoria)
                       <option value="{{$cat->idcategoria}}" selected>{{$cat->nombre}}</option>
                       @else
                       <option value="{{$cat->idcategoria}}">{{$cat->nombre}}</option>
                       @endif
    				@endforeach
    			</select>
    		</div>
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
                <label>Proveedores</label>
                <select name="idproveedor" class="form-control">
                       @foreach ($proveedores as $prov)
                        @if ($prov->idproveedor==$articulo->idproveedor)
                    
                       <option value="{{$prov->idproveedor}}" selected>{{$prov->nombre}}</option>
                       @else
                       <option value="{{$prov->idproveedor}}">{{$prov->nombre}}</option>
                       @endif
                    @endforeach
                </select>
            </div>
        </div>
        </div>

        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    		<div class="form-group">
            	<button class="btn btn-primary" type="submit">Guardar</button>
            	<button class="btn btn-danger" type="reset">Cancelar</button>
            </div>
    	</div>
    </div>
			{!!Form::close()!!}		
            
@push ('scripts')
<script src="{{asset('js/JsBarcode.all.min.js')}}"></script>
<script src="{{asset('js/jquery.PrintArea.js')}}"></script>
<script>
function generarBarcode()
{   
    codigo=$("#codigobar").val();
    JsBarcode("#barcode", codigo, {
    format: "EAN13",
    font: "OCRB",
    fontSize: 18,
    textMargin: 0
    });
}
$('#liAlmacen').addClass("treeview active");
$('#liArticulos').addClass("active");


//Código para imprimir el svg
function imprimir()
{
    $("#print").printArea();
}
generarBarcode();
</script>
@endpush
@endsection