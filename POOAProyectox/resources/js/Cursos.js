$(init)
var table = null;
var cursos = null;
$(document).ready(function () {
    $('#modalRegistro').modal();
});


function init() {
    table = $("#cur").DataTable({
        "aLengthMenu": [[10, 25, 50, 75, 100], [10, 25, 50, 75, 100]],
        "iDisplaylength": 15,
    });

    cargaCursos();
    //Activate modal window
    $('#modalRegistro').modal();

    //Clici Floating action button
    $('#add-record').on("click", function () {
        $('#modalRegistro').modal('open');
        $('#tit').focus();
    });


    $('#guardar').on("click", function () {
        $('#frm-cursos').submit()
    });

    //Click del botón borrar
    $(document).on("click", '.delete', function () {
        var id = $(this).attr("id-record");
        deleteData(id);
    });

    //Click Edit button
    $(document).on("click", '.edit', function () {
        var id = $(this).attr("id-record");
        $("#tit").val(cursos[id]["titulo"]).next().addClass('active');
        $("#descrip").val(cursos[id]["descripcion"]).next().addClass('active');
        $("#pk").val(id);
        $("#modalRegistro").modal('open');
        $("#tit").focus();
    })

}
$("#frm-cursos").validate({
    rules: {
        tit: { required: true, minlength: 8, maxlength: 60 },
        descript: { required: true, minlength: 8, maxlength: 126 },
        cost: { required: true, number: true },

    },
    messages: {
        tit: { required: "Necesitas este campo", minlength: "Debes ingresar al menos 8 caracteres", maxlength: "No puedes exceder los 60 caracteres" },
        descript: { required: "No puedes dejar este campo vacio", minlength: "Debes ingresar al menos 8 caracteres", maxlength: "No puedes exceder los 126 caracteres" },
        cost: { required: "Este campo es requerido", number: "Este campo debe ser numérico" },
    },
    errorElement: "div",
    errorClass: "invalid",
    errorPlacement: function (error, element) {
        error.insertAfter(element)
    },
    submitHandler: function (form) {
        saveData();
    }
});


function cargaCursos() {
    var parametros = "";
    $.ajax({
        type: "post",
        url: "cargacursos.php",
        dataType: 'json',
        data: parametros,
        success: function (response) {
            if (response['status']) {
                cursos = response['data'];
            } else {
                cursos = null;
            }
        },
        error: function (request, status, error) {
            Materialize.toast('Error al cargar el arreglo cursos', 5000);
        }
    });
}
function saveData() {
    var id = $('#pk').val();
    var sURL = "actCurso.php";
    var boton = "";
    if ($('#pk').val() == '0')
        boton = '&boton=Agregar';
    else
        boton = '&boton=Actualizar';
    var params = 'pk=' + $("#pk").val() +
        '&tit=' + $("#tit").val() +
        '&descrip=' + $("#descrip").val() +
        boton;
    console.log(boton);
    $.ajax({
        type: "post",
        url: sURL,
        dataType: 'json',
        data: params,
        success: function (response) {
            if (response['status']) {
                $('#pk').val('0');
                $('#tit').val('');
                $('#descrip').val('');
                $('#modalRegistro').modal('close');
                Materialize.toast('Registro guardado', 5000);
                if (id > 0) {
                    setRow(response['data'], 'delete');
                    setRow(response['data'], 'insert');
                } else {
                    setRow(response['data'], 'insert');
                }
            } else {
                Materialize.toast('Error al guardar ' + error, 5000);
            }
        },
        error: function (request, status, error) {
            console.log(request);
            Materialize.toast('Error al guardar x2: ' + error, 5000);
        }
    });
}

function deleteData(id) {
    var sURL = "actCurso.php";
    boton = '&boton=Eliminar';
    var parametros = 'pk=' + id +
        boton;
    $.ajax({
        type: "post",
        url: sURL,
        dataType: 'json',
        data: parametros,
        success: function (response) {
            if (response['status']) {
                Materialize.toast('Registro Eliminado', 5000);
                setRow(response['data'], 'delete');
            } else {
                Materialize.toast('Error no se pudo eliminar' + response, 5000);
            }
        },
        error: function (request, status, error) {
            Materialize.toast('Error al eliminar', 5000);
        }
    });
}

function setRow(data, action) {
    if (action === 'insert') {
        var row = table.row.add([
            data.tit,
            data.descrip,
            '<i class="material-icons edit" id-record="' + data.pk
            + '">create</i><i class="material-icons delete" id-record="' +
            data.pk + '">delete_forever</i>'
        ]).draw().node();
        $(row).attr('id', data.pk);

        //Hay que agregar el nuevo elemento al arreglo json Cursos
        cursos[data.pk] = {
            "idcurso": data.pk,
            "titcurso": data.tit,
            "descripcurso": data.descrip,
        }
    }
    if (action === 'delete') {
        table.row('#' + data.pk).remove().draw();
    }
}