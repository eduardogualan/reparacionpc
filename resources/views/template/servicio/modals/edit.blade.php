<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-edit"></i> Modificar Marca</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal form-label-left" novalidate autocomplete="off">
                    @include('template.alertas.danger')
                    <input type="hidden" id="id">
                    @include('template.marca.forms.form')
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                            <button  type="button" onclick="Modificar();" class="btn btn-primary"><i class=" fa fa-save"></i> MODIFICAR</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal" ><i class="fa fa-close"></i> CANCELAR </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>