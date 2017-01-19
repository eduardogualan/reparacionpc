function cargarModelo() {
    var url = "/cargarmodeloplan";
    var token = $("#token").val();
    $.ajax({
        url: url,
        headers: {'X-CSRF-TOKEN': token},
        type: "POST",
        data: 'valor=' + $('#marca').val(),
        dataType: "html"
    }).done(function(resp) {
        var valores = eval(resp);
        var html = '';
        $.each(valores, function(i, item) {
            html += '<option value="' + item.id + '">' + item.nombre_modelo + '</option>';
        });
        $("#modelo").html(html);

    });
}


function Cargardatos(nombres) {
    var valor = $('input:radio[name=listaClientes]:checked').val();
    var url = "/cargarcliente";
    var token = $("#token").val();
    $.ajax({
        url: url,
        headers: {'X-CSRF-TOKEN': token},
        type: "POST",
        data: 'valor=' + valor,
        dataType: "html"
    }).done(function(resp) {
        var valores = eval(resp);
        var html = '';
        $.each(valores, function(i, item) {
            $("#cedula").val(item.cedula);
            $("#apellidos").val(item.apellidos);
            $("#nombres").val(item.nombres);
            $("#email").val(item.email);
            $("#telefono").val(item.telefono);
            $("#ciudad").val(item.ciudad);
            $("#direccion").val(item.direccion);

        });
    });
}

function Buscar(valor) {
    var url = "/buscarcliente";
    var token = $("#token").val();
    $.ajax({
        url: url,
        headers: {'X-CSRF-TOKEN': token},
        type: "POST",
        data: 'valor=' + valor,
        dataType: "html"
    }).done(function(resp) {
        var valores = eval(resp);
        var html = '';
        $.each(valores, function(i, item) {
            html += '<li><input type="radio" id="cliente" name="listaClientes" onclick="Cargardatos();" value="' + item.cedula + '"/><label>' + item.apellidos + ' ' + item.nombres + '</label></li>';
        });
        $(".DatosBuscados").html(html);
    });
}

function NroMaquinas(){
    var url = "/numerodemaquinastecnicos";
    var token = $("#token").val();
    $.ajax({
        url: url,
        headers: {'X-CSRF-TOKEN': token},
        type: "POST",
        data: 'valor=' + $('#tecnico').val(),
        dataType: "html"
    }).done(function(resp) {
        $("#nroMaquinas").html(resp);
    });
}


$(function() {
    /**
     * the element
     */
    var $formC = $('#FormC');

    /**
     * on focus and on click display the dropdown, 
     * and change the arrow image
     */
    $formC.find('#cedula').bind('focus click', function() {
        $formC.find()
                .andSelf()
                .find('.DatosBuscados')
                .show();
    });

    /**
     * on mouse leave hide the dropdown, 
     * and change the arrow image
     */
    $formC.bind('mouseleave', function() {
        $formC.find()
                .andSelf()
                .find('.DatosBuscados')
                .hide();
    });
});