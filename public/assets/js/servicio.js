function Buscar(valor){
    var url = "/buscarservicio";
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
           // html += "<tr>  <td>" + item.nombre_marca + "</td> <td><button value='" + item.marca_id + "'class='btn btn-success btn-xs' title='Modificar' onclick='Mostrar(this);' data-toggle='modal' data-target='#edit'><i class='fa fa-edit'></i></button> "+" <button value='" + item.marca_id + "' class='btn btn-danger btn-xs' title='Eliminar' onclick='Eliminar(this);'><i class='fa fa-times-circle-o'></i></button></td> </tr>";
            html += "<tr>  <td>" + item.nombre_servicio + "</td> <td><a href='/servicio/"+item.id+"/edit' class='btn btn-success btn-xs' title='Modificar'><i class='fa fa-edit'></i></a></td> </tr>";
        });
        $("#lista").html(html);
    });
}

