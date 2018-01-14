@extends ('layouts.admin')
@section ('contenido')
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <h3>Editar Sucursal: {{ $sucursales->nombre}}</h3>
            @if (count($errors)>0)
            <div class="alert alert-danger">
                <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
                </ul>
            </div>
            @endif

            {!!Form::model($sucursales,['method'=>'PATCH','route'=>['administracion.sucursales.update',$sucursales->idsucursal]])!!}
            {{Form::token()}}
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" class="form-control" value="{{$sucursales->nombre}}" placeholder="Nombre...">
            </div>
            <div class="form-group">
                <label for="direccion">Direccion</label>
                <input type="text" name="direccion" class="form-control" value="{{$sucursales->direccion}}" placeholder="Direccion...">
            </div>
             <div class="form-group">
                <label for="telefono">Telefono</label>
                <input type="text" name="telefono" class="form-control" value="{{$sucursales->telefono}}" placeholder="Telefono...">
            </div>
            </div>
             <div class="form-group">
              <label for="estado" class="col-md-4 control-label">Estado</label>
                <select name="estado" class="form-control">
                <option value="Activo">Activo</option>
                <option value="Inactivo">Inactivo</option>
                
                       
                </select>
            </div>
            <div class="form-group">
                <button class="btn btn-primary" type="submit">Guardar</button>
                <button class="btn btn-danger" type="reset">Cancelar</button>
            

            {!!Form::close()!!}     
            
        </div>
    </div>
@push ('scripts')
<script>
$('#liAdministracion').addClass("treeview active");
$('#liSucursales').addClass("active");
</script>
@endpush
@endsection