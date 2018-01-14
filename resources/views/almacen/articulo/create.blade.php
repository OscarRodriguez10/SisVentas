<?php
use sisVentas\Proveedores;
$proveedores = Proveedores::lists("nombre","idproveedor");
$proveedores[0] = "seleccione...";
?>
<?php
use sisVentas\Categoria;
$categorias = Categoria::lists("nombre","idcategoria");
$categorias[0] = "seleccione...";
?>



@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
	<h3>Nuevo Artículo</h3>
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
			{!!Form::open(array('url'=>'almacen/articulo','method'=>'POST','autocomplete'=>'off','files'=>'true'))!!}
            {{Form::token()}}
    <div class="row">
    	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    		<div class="form-group">
            	<label for="nombre">Nombre</label>
            	<input type="text" name="nombre" required value="{{old('nombre')}}" class="form-control" placeholder="Nombre...">
            </div>
    	</div>
         
    	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    		<div class="form-group">
            	<label for="preciocosto">PrecioCosto</label>
            	<input type="float" name="preciocosto" required value="{{old('preciocosto')}}" class="form-control" placeholder="Preciocosto del articulo...">
            </div>
    	</div>
    	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    	    <div class="form-group">
            <label for="precioventa">PrecioVenta</label>
            <input type="float" name="precioventa" value="{{old('precioventa')}}" class="form-control" placeholder="PrecioVenta del artículo...">
        </div>
    	</div>
        
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
            <label for="formula">Formula</label>
            <input type="text" name="formula" value="{{old('formula')}}" class="form-control" placeholder="Formula del artículo...">
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
            <label for="bono">Bono</label>
            <input type="float" name="bono" value="{{old('bono')}}" class="form-control" placeholder="Bono del artículo...">
        </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
            <label for="codigo">Barra</label>
            <input type="text" name="bono" value="{{old('codigo')}}" class="form-control" placeholder="barra del articulo...">
        </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
         <div class="form-group">
            <label for="idproveedor" >Proveedor</label>
            {!! Form::select('idproveedor', $proveedores, 0, array('class' => 'form-control input-sm mb15','idproveedor' => 'proveedores')) !!}
            </div>
            </div>
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
         <div class="form-group">
            <label for="idcategoria" >Categoria</label>
            {!! Form::select('idcategoria', $categorias, 0, array('class' => 'form-control input-sm mb15','idcategoria' => 'categorias')) !!}
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
$('#liInventarios').addClass("active");


//Código para imprimir el svg
function imprimir()
{
    $("#print").printArea();
}

</script>
@endpush

@endsection