@extends('../../template.template')
@section('contenido')
<!-- Main content -->
<section class="content">
    <div class="box box-primary">
        <div class="box-header">
            <span class="section"><i class="fa fa-edit"></i> Modificar Modelo</span>
                    @include('template.includs.headerCreate')
                    {!!Form::model($modelo,['route'=>['modelo.update',$modelo->id],'method'=>'PUT', 'class'=>'form-horizontal form-label-left','novalidate','autocomplete'=>'off'])!!}
                        @include('template.alertas.mensajeError')
                        @include('template.modelo.forms.form')
                       <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="marca">Seleccione Una Marca: <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control select2 col-md-7 col-xs-12" required="required" name="marca">
                                    @foreach ($marca as $marca)
                                    <option value="{{$marca->id}}" @if($modelo->marca->nombre_marca == $marca->nombre_marca){{'selected'}} @endif>{{$marca->nombre_marca}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                         
                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-3">
                                <button  type="submit" class="btn btn-primary"><i class=" fa fa-save"></i> MODIFICAR</button>
                                <a href="{!!URL::to('/modelo')!!}" class="btn btn-danger"><i class="fa fa-close"></i> CANCELAR</a>
                            </div>
                        </div>
                    {!!Form::close()!!}
                    @include('template.includs.footerCreate')
</section><!-- /.content -->
@stop