
<div class="item form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="descfalla">Descripción de Falla: <span class="required">*</span>
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
        <textarea  id="descfalla" name="descfalla" required="required" class="form-control col-md-7 col-xs-12" placeholder="Ingrese una descripción de la falla del equipo" onkeyup="ConvertirAMayusculas(this)">{{$orden->descFalla or ''}}</textarea>
    </div>
</div>
<div class="item form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="observaciones">Observaciones: <span class="required">*</span>
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
        <textarea  id="observaciones" name="observaciones" required="required" class="form-control col-md-7 col-xs-12" placeholder="Ingrese una observación del equipo" onkeyup="ConvertirAMayusculas(this)">{{$orden->observaciones or ''}}</textarea>
    </div>
</div>
<div class="item form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nombres">Valor: <span class="required">*</span>
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
        <input id="valor"  class="form-control col-md-7 col-xs-12"  name="valor"  placeholder="Ingrese el precio de reparación del equipo"required="required" type="text"  onkeypress="return SoloNumerosDecimales(event, '0.0', 6, 2);" value="{{$orden->valor or ''}}">
    </div>
</div>