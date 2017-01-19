<h2 class="page-header">INFORMACIÓN DEL EQUIPO</h2>
@foreach ($datosMaquina as $item)
<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <!-- Widget: user widget style 1 -->
        <div class="box box-widget widget-user-2">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-aqua">
                <h3 class="widget-user-username center"><strong>EQUIPO: </strong>{{$item->nombre_equipo}}</h3>
                <h5 class="widget-user-desc"><strong>MARCA: </strong>{{$item->nombre_marca}}</h5>
                <h5 class="widget-user-desc"><strong>MODELO: </strong>{{$item->nombre_modelo}}</h5>
            </div>
            <div class="box-footer no-padding">
                <ul class="nav nav-stacked">
                    <li> <strong>Fecha de Ingreso:</strong> <span class="pull-right">{{$item->FIngreso}}</span></li>
                    <li> <strong>Número de Orden:</strong> <span class="pull-right">{{$item->nroOrden}}</span></li>
                    <li> <strong>Técnico Responsable:</strong> <span class="pull-right">{{$item->codTecnico}}</span></li>
                    <li><strong>Estado:</strong> <span class="pull-right badge bg-red">{{$item->estado}}</span></li>
                    <li> <strong>Valor:</strong> <span class="pull-right">{{$item->valor}}</span></li>
                    <li></li>
                </ul>
                <div class="pull-right"><a href="#" class="btn btn-xs btn-primary"><i class=" fa fa-print"></i> IMPRIMIR REPORTE</a></div>
            </div>
            
        </div><!-- /.widget-user -->
    </div><!-- /.col -->
    <div class="col-md-2"></div>
</div><!-- /.row -->
@endforeach