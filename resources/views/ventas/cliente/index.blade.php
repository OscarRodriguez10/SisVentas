@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de Clientes <a href="cliente/create"><button class="btn btn-success">Nuevo</button></a> <a href="{{url('reporteclientes')}}" target="_blank"><button class="btn btn-info">Reporte</button></a></h3>
		@include('ventas.cliente.search')
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
					<th>TelefonoS</th>
					<th>Nit</th>
					<th>Email</th>
					<th>Estado</th>
					<th>Opciones</th>
				</thead>
               @foreach ($clientes as $cli)
				<tr>
					<td>{{ $cli->idcliente}}</td>
					<td>{{ $cli->nombre}}</td>
					<td>{{ $cli->direccion}}</td>
					<td>{{ $cli->telefono}}</td>
					<td>{{ $cli->nit}}</td>
					<td>{{ $cli->email}}</td>
					<td>{{ $cli->estado}}</td>
					

					<td>

						<a href="{{URL::action('ClienteController@edit',$cli->idcliente)}}"><button class="btn btn-info">Editar</button></a>
                         <a href="" data-target="#modal-delete-{{$cli->idcliente}}"echo ($cli); data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
					</td>
				</tr>
				@include('ventas.cliente.modal')
				@endforeach
			</table>
		</div>
		{{$clientes->render()}}
	</div>
</div>
@push ('scripts')
<script>
$('#liVentas').addClass("treeview active");
$('#liClientes').addClass("active");
</script>
@endpush
@endsection