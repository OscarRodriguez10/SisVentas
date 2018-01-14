<?php
use sisVentas\Sucursales;
$sucursales = Sucursales::lists("nombre","idsucursal");
$sucursales[0] = "seleccione...";
?>


@extends ('layouts.admin')
@section ('contenido')
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <h3>Editar Empleado: {{ $empleados->nombre}}</h3>
            @if (count($errors)>0)
            <div class="alert alert-danger">
                <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
                </ul>
            </div>
            @endif

            {!!Form::model($empleados,['method'=>'PATCH','route'=>['administracion.empleados.update',$empleados->idempleados]])!!}
            {{Form::token()}}
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" class="form-control" value="{{$empleados->nombre}}" placeholder="Nombre...">
            </div>
            <div class="form-group">
                <label for="dpi">Dpi</label>
                <input type="text" name="dpi" class="form-control" value="{{$empleados->dpi}}" placeholder="DPI...">
            </div>
            <div class="form-group">
                <label for="direccion">Direccion</label>
                <input type="text" name="direccion" class="form-control" value="{{$empleados->direccion}}" placeholder="Direccion...">
            </div>
             <div class="form-group">
                <label for="telefono">Telefono</label>
                <input type="text" name="telefono" class="form-control" value="{{$empleados->telefono}}" placeholder="Telefono...">
            </div>
             <div class="form-group">
                <label for="fechainicio">FechaInicial</label>
                <input type="date" name="fechainicio" class="form-control" value="{{$empleados->fechainicio}}">
            </div>
               <div class="form-group">
                <label for="fechafinal">FechaFinal</label>
                <input type="date" name="fechafinal" class="form-control" value="{{$empleados->fechafinal}}">
            </div>
              <div class="form-group">
              <label for="puesto" class="col-md-4 control-label">Puesto</label>
                <select name="puesto" class="form-control">
                <option value="cajero">Cajero</option>
                <option value="encargado">Encargado</option>
                <option value="gerente">Gerentes</option>
                       
                </select>
            </div>
             <div class="form-group">
             <label for="idsucursal" class="col-md-4 control-label">Sucursal</label>
            {!! Form::select('idsucursal', $sucursales, 0, array('class' => 'form-control input-sm mb15','idsucursal' => 'sucursales')) !!}
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
            </div>

            {!!Form::close()!!}     
            
        </div>
    </div>
@push ('scripts')
<script>
$('#liAdministracion').addClass("treeview active");
$('#liEmpleados').addClass("active");
</script>
@endpush
@endsection