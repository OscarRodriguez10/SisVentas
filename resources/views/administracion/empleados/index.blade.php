@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de Empleados <a href="empleados/create"><button class="btn btn-success">Nuevo</button></a> <a href="{{url('reportesucursales')}}" target="_blank"><button class="btn btn-info">Reporte</button></a></h3>
		@include('administracion.empleados.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Id</th>
					<th>Nombre</th>
					<th>DPI</th>
					<th>Direccion</th>
					<th>Telefono</th>
					<th>Puesto</th>
					<th>Sucursal</th>
					<th>FechaInicio</th>
					<th>FechaFinal</th>
					<th>Opciones</th>
				</thead>
               @foreach ($empleados as $emp)
				<tr>
					<td>{{ $emp->idempleado}}</td>
					<td>{{ $emp->nombre}}</td>
					<td>{{ $emp->dpi}}</td>
					<td>{{ $emp->direccion}}</td>
					<td>{{ $emp->telefono}}</td>
					<td>{{ $emp->puesto}}</td>
					<td>{{ $emp->sucursales}}</td>
					<td>{{ $emp->fechainicio}}</td>
					<td>{{ $emp->fechafinal}}</td>
					<td>{{ $emp->estado}}</td>
					<td>
						<a href="{{URL::action('EmpleadosController@edit',$emp->idempleado)}}"><button class="btn btn-info">Editar</button></a>
                         <a href="" data-target="#modal-delete-{{$emp->idempleado}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
					</td>
				</tr>
				@include('administracion.empleados.modal')
				@endforeach
			</table>
		</div>
		{{$empleados->render()}}
	</div>
</div>
@push ('scripts')
<script>
$('#liAdministracion').addClass("treeview active");
$('#liEmpleados').addClass("active");
</script>
@endpush
@endsection