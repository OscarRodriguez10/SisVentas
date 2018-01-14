@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de Sucursales <a href="sucursales/create"><button class="btn btn-success">Nuevo</button></a> <a href="{{url('reportesucursales')}}" target="_blank"><button class="btn btn-info">Reporte</button></a></h3>
		@include('administracion.sucursales.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Id</th>
					<th>Nombre</th>
					<th>Direccion</th>
					<th>Telefono</th>
					<th>Estado</th>
					<th>Opciones</th>
				</thead>
               @foreach ($sucursales as $suc)
				<tr>
					<td>{{ $suc->idsucursal}}</td>
					<td>{{ $suc->nombre}}</td>
					<td>{{ $suc->direccion}}</td>
					<td>{{ $suc->telefono}}</td>
					<td>{{ $suc->estado}}</td>
					<td>
						<a href="{{URL::action('SucursalesController@edit',$suc->idsucursal)}}"><button class="btn btn-info">Editar</button></a>
                         <a href="" data-target="#modal-delete-{{$suc->idsucursal}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
					</td>
				</tr>
				@include('administracion.sucursales.modal')
				@endforeach
			</table>
		</div>
		{{$sucursales->render()}}
	</div>
</div>
@push ('scripts')
<script>
$('#liAdministracion').addClass("treeview active");
$('#liSucursales').addClass("active");
</script>
@endpush
@endsection