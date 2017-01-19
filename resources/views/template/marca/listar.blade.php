@extends('../../template.template')
@section('contenido')
<!-- Main content -->
<script>
    function Listar(){
        Buscar('');
    }
    window.onload = Listar;
</script>
<section class="content">
    <div class="box box-danger">
        <div class="box-header">
            <a href="{!!URL::to('/marca/create')!!}" class="btn btn-primary"><i class="fa fa fa-pencil"></i> NUEVO</a>
              <div class="box-tools pull-right">
            <form id="formB">
                <input type="hidden" id="token" name="_token" value="{{ csrf_token()}}">
                <div class="form-group has-feedback">
                    <input type="text" id="buscar" class="form-control" placeholder="buscar" onkeyup="Buscar(this.value);">
                    <span class="glyphicon glyphicon-search form-control-feedback"></span>
                </div>
            </form>
        </div>
            @include('template.includs.headerlistar')
             @include('template.marca.modals.edit')
             @include('template.alertas.mensajeOk')
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody id="lista">
                    @include('template.includs.footerListar')
</section><!-- /.content -->
                    @stop
                    @section('scripts')
                    {!!Html::script('assets/js/marca.js')!!}
                    @endsection