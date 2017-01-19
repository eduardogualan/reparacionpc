@if(Session::has('mensajeOK'))
<div class="form-group">
    <div class="alert alert-success text-center alert-dismissable" role="alert">
        <strong>{{Session::get('mensajeOK')}}</strong>
    </div> 
</div>
@endif