$(init);
var table = null;
var cursos = null;

function init() {
    // Configuración del DataTable
    table = $('#cur').DataTable({
        "aLengthMenu":
            [[10, 25, 50, 75, 100], [10, 25, 50, 75, 100]],
        "iDisplaylength": 15
    });

    cargaCursos();

    // Activar la validación del formulario
    $('#modalRegistro').modal();
    validateForm();

    // Evento clic del floatbutton agregar
    $('#add-record').on("click", function () {
        $('#modalRegistro').modal('open');
        $('#tit').focus();
    });

    // clic del boton de guardar
    $('#guardar').on("click", function () {
        $('#frm-cursos').submit();
    });

    // Clic del boton de borrar
    $(document).on("click", '.delete', function () {
        var id = $(this).attr("id-record");
        deleteData(id);
    });

    // Clic del boton de borrar
    $(document).on("click", '.edit', function () {
        var id = $(this).attr("id-record");
        $("#tit").val(cursos[id]["titcurso"]).next().addClass('active');
        $("#descrip").val(cursos[id]["descripcurso"]).next().addClass('active');
        $("#pk").val(id);
        $("#modalRegistro").modal('open');
        $("#tit").focus();
    });

}

function validateForm() {
    $('#frm-cursos').validate({
        rules: {
            'tit': {
                required: true
            },
            'descrip': {
                required: true  //,
                //digits: true
            }
        },
        messages: {
            'tit': {
                required: 'Campo requerido'
            },
            'descrip': {
                required: 'Campo requerido' //,
                //digits: 'Ingrese solo números'
            }
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
}

function cargaCursos() {
    var parametros = "";
    $.ajax({
        type: "post",
        url: "llenaArrayCursos.php",
        dataType: 'json',
        data: parametros,
        success: function (response) {
            if (response['status']) {
                cursos = response['data']; // Carga solo el arreglo de cursos   
            } else {
                cursos = null;
            }
        },
        error: function (request, status, error) {
            Materialize.toast('Error al cargar el arreclo Cursos', 5000);
        }
    });
}

function saveData() {
    var id = $("#pk").val();
    var sURL = "ActCurso.php";
    var boton = "";
    if ($("#pk").val() == '0')
        boton = '&boton=Agregar';
    else
        boton = '&boton=Actualizar';
    var parametros = 'pk=' + $("#pk").val() +
        '&tit=' + $("#tit").val() +
        '&descrip=' + $("#descrip").val() +
        boton;
    console.log(boton);    
    $.ajax({
        type: "post",
        url: sURL,
        dataType: 'json',
        data: parametros,
        success: function (response) {
            if (response['status']) {
                $("#pk").val('0');
                $("#tit").val('');
                $("#descrip").val('');
                $('#modalRegistro').modal('close');
                Materialize.toast('Registro Guardado', 5000);
                if (id > 0) { // Esta editando y para actualizar el dataTable elimina el registro y lo inserta
                    setRow(response['data'], 'delete');
                    setRow(response['data'], 'insert');
                }
                else { // Se jecuta cueando agregamos un nuevo registro
                    setRow(response['data'], 'insert');
                }

            } else {
                Materialize.toast('Error en Guardado' + response, 5000);
            }
        },
        error: function (request, status, error) {
            console.log(request);
            Materialize.toast('Error en Guardado' + error, 5000);
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

// Función para agregar o eliminar un renglon de la tabla
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
