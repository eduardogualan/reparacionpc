@extends('../../template.template')
@section('contenido')
<!-- Main content -->
<section class="content">
    <div class="box box-primary">
        <div class="box-header">
            <span class="section"><i class="fa fa-pencil"></i> SISTEMA DE SEGUIMIENTO Y REPARACION DE EQUIPOS INFORMATICOS</span>
                    @include('template.includs.headerCreate')
    @if (Auth::user()->ObtenerRol(Auth::user()->usuario)=='Administrador')
    <h3>contenido admin</h3>
    @endif
    @if (Auth::user()->ObtenerRol(Auth::user()->usuario)=='Recepcion')
    <h3>contenido recepcion</h3>
    @endif
    @if (Auth::user()->ObtenerRol(Auth::user()->usuario)=='Tecnico')
    @include('template.principal.forms.formTecnico')
    @endif
    @if (Auth::user()->ObtenerRol(Auth::user()->usuario)=='Cliente')
    @include('template.principal.forms.formCliente')
    @endif
@include('template.includs.footerCreate')
</section><!-- /.content -->
@stop