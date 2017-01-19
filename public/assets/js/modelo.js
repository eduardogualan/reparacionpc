function Buscar(valor) {
    var url = "/buscarmodelo";
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
            html += "<tr>  <td>" + item.nombre_marca + "</td> <td>" + item.nombre_modelo + "</td> <td><a href='/modelo/"+item.id+"/edit' class='btn btn-success btn-xs' title='Modificar'><i class='fa fa-edit'></i></a></td> </tr>";
        });
        $("#lista").html(html);
    });
}




