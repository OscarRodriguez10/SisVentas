@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Editar Proveedor: {{ $proveedores->nombre}}</h3>
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
			{!!Form::model($proveedores,['method'=>'PATCH','route'=>['almacen.proveedores.update',$proveedores->idproveedor]])!!}
            {{Form::token()}}
    <div class="row">
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" required value="{{$proveedores->nombre}}" class="form-control" placeholder="Nombre...">
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="nombre_contacto">NombreContacto</label>
                <input type="text" name="nombre_contacto" value="{{$proveedores->nombre_contacto}}" class="form-control" placeholder="NombreContacto...">
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="direccion">Direccion</label>
                <input type="text" name="direccion" value="{{$proveedores->direccion}}" class="form-control" placeholder="Dirección...">
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="telefono">Telefono</label>
                <input type="text" name="telefono" value="{{$proveedores->telefono}}" class="form-control" placeholder="Telefono...">
            </div>
        </div>
      <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label>Politica</label>
                <select name="politica" class="form-control">
        <option value="NO TIENE DEVOLUCION">NO TIENE DEVOLUCION</option>
        <option value="EN EL MES">EN EL MES</option>
        <option value="1 MES ANTES">1 MES ANTES</option>
        <option value="2 MESES ANTES">2 MESES ANTES</option>
        <option value="3 MESES ANTES">3 MESES ANTES</option>
        <option value="4 MESES ANTES">4 MESES ANTES</option>
        <option value="5 MESES ANTES">5 MESES ANTES</option>
        <option value="6 MESES ANTES">6 MESES ANTES</option>
                </select>
            </div>
        </div>

        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="email">Correo</label>
                <input type="text" name="email" value="{{$proveedores->email}}" class="form-control" placeholder="Correo...">
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="nombre_cuenta">NombreCuenta</label>
                <input type="text" name="nombre_cuenta" value="{{$proveedores->nombre_cuenta}}" class="form-control" placeholder="NombreCuenta...">
            </div>
        </div>
        
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label>Opcion de Compra</label>
                <select name="opcion_compra" class="form-control">
                       <option value="AL CONTADO">Al CONTADO</option>
                       <option value="CREDITO 15 DIAS">CREDITO 15 DIAS</option>
                       <option value="CREDITO 30 DIAS">CREDITO 30 DIAS</option>
                       <option value="CREDITO 45 DIAS">CREDITO 45 DIAS</option>
                       <option value="CRIDTO  60 DIAS">CREDITO 60 DIAS</option>
                       <option value="CREDITO 90 DIAS">CREDITO 90 DIAS</option>
                </select>
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="no_cuenta">Numero de Cuenta</label>
                <input type="text" name="no_cuenta" value="{{$proveedores->no_cuenta}}" class="form-control" placeholder="NoCuenta...">
            </div>
        </div>
         <d6v class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
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
                <button class="btn btn-primary" type="submit">Editar</button>
                <button class="btn btn-danger" type="reset">Cancelar</button>
            </div>
        </div>
    </div> 
{!!Form::close()!!}		
            
@push ('scripts')
<script>
$('#liAlmacen').addClass("treeview active");
$('#liProveedores').addClass("active");
</script>
@endpush
@endsection