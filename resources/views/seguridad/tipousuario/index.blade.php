@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de Tipo de roles <a href="tipousuario/create"><button class="btn btn-success">Nuevo</button></a> <a href="{{url('reportecategorias')}}" target="_blank"><button class="btn btn-info">Reporte</button></a></h3>
		@include('seguridad.tipousuario.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Id</th>
					<th>Descripción</th>
					<th>Opciones</th>
				</thead>
               @foreach ($tipousuario as $tipo)
				<tr>
					<td>{{ $tipo->idtipo}}</td>
					<td>{{ $tipo->descripcion}}</td>
					<td>
						<a href="{{URL::action('TipoUsuarioController@edit',$tipo->idtipo)}}"><button class="btn btn-info">Editar</button></a>
                         <a href="" data-target="#modal-delete-{{$tipo->idtipo}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
					</td>
				</tr>
				@include('seguridad.tipousuario.modal')
				@endforeach
			</table>
		</div>
		{{$tipousuario->render()}}
	</div>
</div>
@push ('scripts')
<script>
$('#liSeguridad').addClass("treeview active");
$('#liTipoUsuario').addClass("active");
</script>
@endpush
@endsection