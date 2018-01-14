@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de Proveedores <a href="proveedores/create"><button class="btn btn-success">Nuevo</button></a> <a href="{{url('reporteproveedores')}}" target="_blank"><button class="btn btn-info">Reporte</button></a></h3>
		@include('almacen.proveedores.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Id</th>
					<th>Nombre</th>
					<th>NombreContacto</th>
					<th>Direccion</th>
					<th>Telefono</th>
					<th>Politica</th>
					<th>Email</th>
					<th>NombeCuenta</th>
					<th>NoCuenta</th>
					<th>Opc Compra</th>
					<th>Estado</th>
					<th>Opciones</th>
				</thead>
               @foreach ($proveedores as $prov)
				<tr>
					<td>{{ $prov->idproveedor}}</td>
					<td>{{ $prov->nombre}}</td>
					<td>{{ $prov->nombre_contacto}}</td>
					<td>{{ $prov->direccion}}</td>
					<td>{{ $prov->telefono}}</td>
					<td>{{ $prov->politica}}</td>
					<td>{{ $prov->email}}</td>
					<td>{{ $prov->nombre_cuenta}}</td>
					<td>{{ $prov->no_cuenta}}</td>
					<td>{{ $prov->opcion_compra}}</td>
					<td>{{ $prov->estado}}</td>
					<td>
						<a href="{{URL::action('ProveedoresController@edit',$prov->idproveedor)}}"><button class="btn btn-info">Editar</button></a>
                         <a href="" data-target="#modal-delete-{{$prov->idproveedor}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
					</td>
				</tr>
				@include('almacen.proveedores.modal')
				@endforeach
			</table>
		</div>
		{{$proveedores->render()}}
	</div>
</div>
@push ('scripts')
<script>
$('#liAlmacen').addClass("treeview active");
$('#liProveedores').addClass("active");
</script>
@endpush
@endsection