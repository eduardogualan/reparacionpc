
function Buscar(valor) {
    var url = "/buscarequipo";
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
            html += "<tr>  <td>" + item.nombre_equipo + "</td> <td><a href='/equipo/"+item.id+"/edit' class='btn btn-success btn-xs' title='Modificar'><i class='fa fa-edit'></i></a></td> </tr>";
        });
        $("#lista").html(html);
    });
}

//function Mostrar(btn) {
//    var route = "/marca/" + btn.value + "/edit";
//    $.get(route, function(res) {
//        $("#nombre").val(res.nombre_marca);
//        $("#id").val(res.marca_id);
//    });
//}
//
//function CargarTabla() {
//    var route = "/marca";
//    $("#listar").empty();
//    Buscar('');
//}
//
//function Modificar() {
//    var value = $("#id").val();
//    var nombre = $("#nombre").val();
//    var route = "/marca/" + value;
//    var token = $("#token").val();
//
//    $.ajax({
//        url: route,
//        headers: {'X-CSRF-TOKEN': token},
//        type: 'PUT',
//        dataType: 'html',
//        data: {nombre: nombre},
//        success: function(data) {
//            if (data =='2') {
//               alert('duplicado');
//            }else{
//                 $("#edit").modal('toggle');
//                $("#succes").fadeIn();
//                CargarTabla();
//               // $("#danger").fadeIn();
//            }
//
//        }
//    });
//}

function Eliminar(btn) {
    console.log(btn.value);
}



