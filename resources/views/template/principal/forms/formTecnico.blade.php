
<h2 class="page-header">LISTA DE EQUIPOS</h2>
<div class="row">
    <div class="col-md-3">
        <div class="box box-solid">
            <div class="box-body no-padding">
                <ul class="nav nav-pills nav-stacked">
                    <li><a href="#"><i class="fa fa-envelope-o"></i>Ingresados</a></li>
                    <li><a href="#"><i class="fa fa-file-text-o"></i> En Reparacion</a></li>
                    <li><a href="#"><i class="fa fa-filter"></i> Reparados<span class="label label-warning pull-right">65</span></a></li>
                </ul>
            </div><!-- /.box-body -->
        </div><!-- /. box -->
    </div><!-- /.col -->
    <div class="col-md-9">
        <div class="table-responsive mailbox-messages">
            <table class="table table-hover table-striped">
                <tbody>
                    @foreach ($datosMaquinaTecnico as $item)
                    <tr>
                        <td><input type="checkbox"></td>
                        <td class="mailbox-star"><i class="fa fa-star text-yellow"></i></td>
                        <td class="mailbox-name">{{$item->nombre_equipo}} {{$item->nombre_marca}} {{$item->nombre_modelo}}</td>
                        <td class="mailbox-subject"><b>Desc. Falla </b>{{$item->descFalla}}</td>
                        <td class="mailbox-subject"><b>Observ. </b>{{$item->observaciones}}</td>
                        <td class="mailbox-subject"><b>Fecha Ingreso </b>{{$item->FIngreso}}</td>
                        <td class="mailbox-subject"><b>Estado </b>{{$item->estado}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div><!-- /.row -->