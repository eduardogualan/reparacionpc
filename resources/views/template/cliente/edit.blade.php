@extends('../../template.template')
@section('contenido')
<!-- Main content -->
<section class="content">
    <div class="box box-primary">
        <div class="box-header">
            <span class="section"><i class="fa fa-edit"></i> Modificar Clientes</span>
                    @include('template.includs.headerCreate')
                    {!!Form::model($persona,['route'=>['cliente.update',$persona->id],'method'=>'PUT', 'class'=>'form-horizontal form-label-left','novalidate','autocomplete'=>'off'])!!}
                        @include('template.alertas.mensajeError')
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cedula">Cédula o Ruc: <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="cedula"  class="form-control col-md-7 col-xs-12"  name="cedula"  type="cedula_ruc" readonly="readonly" value="{{$persona->cedula}}">
                            </div>
                        </div>
                         @include('template.cliente.forms.form')
                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-3">
                                <button  type="submit" class="btn btn-primary"><i class=" fa fa-save"></i> MODIFICAR</button>
                                <a href="{!!URL::to('/cliente')!!}" class="btn btn-danger"><i class="fa fa-close"></i> CANCELAR</a>
                            </div>
                        </div>
                    {!!Form::close()!!}
                    @include('template.includs.footerCreate')
</section><!-- /.content -->
@stop