@if(Session::has('mensajeError'))
<div class="form-group">
    <div class="alert alert-danger text-center alert-dismissable" role="alert">
        <strong>{{Session::get('mensajeError')}}</strong>
    </div> 
</div>
@endif