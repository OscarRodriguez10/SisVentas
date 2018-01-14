@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de Articulos de Inventarios <a href="inventarios/create"><button class="btn btn-success">Nuevo</button></a> <a href="{{url('reportesInventarios')}}" target="_blank"><button class="btn btn-info">Reporte</button></a></h3>
		@include('almacen.inventarios.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Id</th>
					<th>Cantidad</th>
					<th>idarticulo</th>
					<th>Nombre</th>
					<th>Costo</th>
					<th>Venta</th>
					<th>Sucursal</th>
					<th>Estado</th>
					<th>Opciones</th>
				</thead>
               @foreach ($inventarios as $inv)
				<tr>
					<td>{{ $inv->idinventario}}</td>
					<td>{{ $inv->cantidad}}</td>
					<td>{{ $inv->idarticulo}}</td>
					<td>{{ $inv->descripcion}}</td>
					<td>{{ $inv->preciocosto}}</td>
					<td>{{ $inv->precioventa}}</td>
					<td>{{ $inv->sucursales}}</td>
					<td>{{ $inv->estado}}</td>
					<td>
						<a href="{{URL::action('InventariosController@edit',$inv->idinventario)}}"><button class="btn btn-info">Editar</button></a>
                         <a href="" data-target="#modal-delete-{{$inv->idinventario}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
					</td>
				</tr>
				@include('almacen.inventarios.modal')
				@endforeach
			</table>
		</div>
		{{$inventarios->render()}}
	</div>
</div>
@push ('scripts')
<script>
$('#liAlmacen').addClass("treeview active");
$('#liInventarios').addClass("active");
</script>
@endpush
@endsection
