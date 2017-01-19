@extends('../../template.template')
@section('contenido')
<!-- Main content -->
<script>
    function Listar() {
        Buscar('');
    }
    window.onload = Listar;
</script>
<section class="content">
    <div class="box box-primary">
        <div class="box-header">
            <span class="section"><i class="fa fa-pencil"></i> Registrar Clientes</span>
                    @include('template.includs.headerCreate')
                    {!!Form::open(['route'=>'cliente.store','method'=>'POST','id'=>'FormC','class'=>'form_cliente form-horizontal form-label-left','novalidate','autocomplete'=>'off'])!!}
                    @include('template.alertas.mensajeError')
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cedula">Cédula o Ruc: <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="cedula"  class="form-control col-md-7 col-xs-12"  name="cedula"  placeholder="Ingrese el número de cédula o ruc del cliente"required="required" type="cedula_ruc" onkeypress="return Solo_numeros(event)" maxlength="13" onkeyup="Buscar(this.value);">
                                <ul class="DatosBuscados" style="display:none;">
                                </ul>
                            </div>
                        </div>
                         @include('template.cliente.forms.form')
                         <div class="box-header">
                            <span class="section"><i class="fa fa-database"></i> Datos de Recepción</span>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="marca">Seleccione Una Marca: <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control select2 col-md-7 col-xs-12" required="required" name="marca" onchange="cargarModelo()" id="marca">
                                    <option value="">Seleccione---> </option>
                                    @foreach ($marca as $marca)
                                    <option value="{{$marca->id}}">{{$marca->nombre_marca}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="modelo">Seleccione Un Modelo: <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control select2 col-md-7 col-xs-12" required="required" name="modelo" id="modelo">
                                    
                                </select>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="equipo">Seleccione Un Equipo: <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control select2 col-md-7 col-xs-12" required="required" name="equipo">
                                    <option value="">Seleccione---> </option>
                                    @foreach ($equipo as $equipo)
                                    <option value="{{$equipo->id}}">{{$equipo->nombre_equipo}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                         <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="servicio">Seleccione Un Servicio: <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control select2 col-md-7 col-xs-12" required="required" name="servicio" onchange="cargarModelo()" id="marca">
                                    <option value="">Seleccione---> </option>
                                    @foreach ($servicio as $servicio)
                                    <option value="{{$servicio->id}}">{{$servicio->nombre_servicio}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                         @include('template.cliente.forms.formOrden')
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tecnico">Seleccione Un Tecnico: <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <small class="label label-danger" id="nroMaquinas"></small>
                                <select class="form-control select2 col-md-7 col-xs-12" required="required" name="tecnico" id="tecnico" onchange="NroMaquinas();">
                                    <option value="">Seleccione---> </option>
                                    @foreach ($tecnico as $tecnico)
                                    <option value="{{$tecnico->cedula}}">{{$tecnico->apellidos}}{{" "}}{{$tecnico->nombres}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-3">
                                <button  type="submit" class="btn btn-primary"><i class=" fa fa-save"></i> GUARDAR</button>
                                @if (Auth::user()->ObtenerRol(Auth::user()->usuario)=='Administrador')
                                <a href="{!!URL::to('/cliente')!!}" class="btn btn-danger"><i class="fa fa-close"></i> CANCELAR</a>
                                @endif
                                @if (Auth::user()->ObtenerRol(Auth::user()->usuario)=='Recepcion')
                                <a href="{!!URL::to('/orden')!!}" class="btn btn-danger"><i class="fa fa-close"></i> CANCELAR</a>
                                @endif
                            </div>
                        </div>
                    {!!Form::close()!!}
                    @include('template.includs.footerCreate')
</section><!-- /.content -->
@stop
@section('scripts')
                    {!!Html::script('assets/js/buscarcliente.js')!!}
                    @endsection
