@extends('../../template.template')
@section('contenido')
<!-- Main content -->
<section class="content">
    <div class="box box-primary">
        <div class="box-header">
            <span class="section"><i class="fa fa-pencil"></i> Registrar Equipo</span>
                    @include('template.includs.headerCreate')
                    {!!Form::open(['route'=>'equipo.store','method'=>'POST', 'class'=>'form-horizontal form-label-left','novalidate','autocomplete'=>'off'])!!}
                        @include('template.alertas.mensajeError')
                         @include('template.equipo.forms.form')
                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-3">
                                <button  type="submit" class="btn btn-primary"><i class=" fa fa-save"></i> GUARDAR</button>
                                <a href="{!!URL::to('/equipo')!!}" class="btn btn-danger"><i class="fa fa-close"></i> CANCELAR</a>
                            </div>
                        </div>
                    {!!Form::close()!!}
                    @include('template.includs.footerCreate')
</section><!-- /.content -->
@stop