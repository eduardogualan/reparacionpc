<input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
<div class="item form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Nombre: <span class="required">*</span>
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
        <input id="nombre"  class="form-control col-md-7 col-xs-12"  name="nombre"  placeholder="Ingrese el nombre de un equipo"required="required" type="text"  onkeyup="ConvertirAMayusculas(this)" onkeypress="return Solo_letras(event)" value="{{$equipo->nombre_equipo or ''}}">
    </div>
</div>
