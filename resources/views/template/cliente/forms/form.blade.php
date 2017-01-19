<input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
<div class="item form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="apellidos">Apellidos: <span class="required">*</span>
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
        <input id="apellidos"  class="form-control col-md-7 col-xs-12"  name="apellidos"  placeholder="Ingrese los apellidos del cliente"required="required" type="text"  onkeyup="ConvertirAMayusculas(this)" value="{{$persona->apellidos or ''}}" onkeypress="return Solo_letras(event)">
    </div>
</div>
<div class="item form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nombres">Nombres: <span class="required">*</span>
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
        <input id="nombres"  class="form-control col-md-7 col-xs-12"  name="nombres"  placeholder="Ingrese los nombres del cliente"required="required" type="text"  onkeyup="ConvertirAMayusculas(this)" value="{{$persona->nombres or ''}}" onkeypress="return Solo_letras(event)">
    </div>
</div>
<div class="item form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email: <span class="required">*</span>
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
        <input type="email" id="email" name="email" required="required" class="form-control col-md-7 col-xs-12" placeholder="Ingrese el email del cliente" value="{{$persona->email or ''}} ">
    </div>
</div>
<div class="item form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="telefono">Teléfono o Celular:
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
        <input type="text" id="telefono" name="telefono" class="form-control col-md-7 col-xs-12" onkeypress="return Solo_numeros(event)" placeholder="Ingrese el número de teléfono o celular del usuario (opcional)" value="{{$persona->telefono or ''}}">
    </div>
</div>
<div class="item form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ciudad">Ciudad:
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
        <input type="text" id="ciudad" name="ciudad" class="form-control col-md-7 col-xs-12" onkeypress="return Solo_letras(event)" placeholder="Ingrese la ciudad de recidencia del cliente (opcional)" value="{{$persona->ciudad or ''}}" onkeyup="ConvertirAMayusculas(this)">
    </div>
</div>
<div class="item form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="direccion">Direción: <span class="required">*</span>
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
        <input type="text" id="direccion" name="direccion" required="required" class="form-control col-md-7 col-xs-12" placeholder="Ingrese la dirección del cliente" value="{{$persona->direccion or ''}}" onkeyup="ConvertirAMayusculas(this)">
    </div>
</div>





