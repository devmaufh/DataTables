
var table = null;
var students = null;
//initialize materializecss components
$(document).ready(function () {
    $('select').formSelect();
    $('.datepicker').datepicker();
    $('.modal').modal();
    $(init);

});


function init() {
    table = $("#students").DataTable({
        "aLengthMenu": [[10, 25, 50, 75, 100], [10, 25, 50, 75, 100]],
        "iDisplaylength": 15,
    });
    cargaStudents();

    $('#guardar').on("click", function () {
        $("#frm-students").submit();
    });
    $('#add-record').on("click", function () {
        console.log("id-> " + $('#pk').val());

        $('#modalRegistro').modal('open');
        $('#name').focus();
    });
    $(document).on("click", '.delete', function () {
        var id = $(this).attr("id-record");
        deleteData(id);
    });

    //Click Edit button
    $(document).on("click", '.edit', function () {
        var id = $(this).attr("id-record");
        $("#name").val(students[id]["nombre"]).next().addClass('active');
        $("#dom").val(students[id]["domicilio"]).next().addClass('active');
        $("#fecha").val(students[id]["fecha"]).next().addClass('active');        
        $("#pk").val(id);
        $("#modalRegistro").modal('open');
        $("#name").focus();
    })
    validateForm();
}
function validateForm() {
    $('#frm-students').validate({
        rules: {
            name: { required: true, minlength: 5, maxlength: 120 },
            dom: { required: true, minlength: 5, maxlength: 126 },
            fecha: { required: true, date: true },
        },
        messages: {
            name: { required: "Necesitas ingresar el nombre", minlength: "Debes ingresar al menos 5 caracteres", maxlength: "No puedes exceder los 120 caracteres" },
            dom: { required: "Debes ingresar el domicilio", minlength: "Debes ingresar al menos 5 caracteres", maxlength: "No puedes exceder los 126 caracteres" },
            fecha: { required: "No puedes dejar este campo vacío", date: " Debes ingresar una fecha válida" },
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
function saveData() {
    var id = $('#pk').val();
    var boton = "";
    if (id == '0')
        boton = "&boton=Agregar";
    else
        boton = "&boton=Actualizar";
    var params = 'pk=' + $('#pk').val() + '&name=' + $('#name').val() + '&dom=' + $('#dom').val() + '&sex=' + $('#sex').val() + '&fecha=' + $('#fecha').val() + boton;
    console.log(params);
    $.ajax({
        type: "post",
        url: "actStudent.php",
        dataType: "json",
        data: params,
        success: function (response) {
            if (response['status']) {
                $('#pk').val('0');
                $('#name').val('');
                $('#dom').val('');
                $('#sex').val('');
                $('#fecha').val('');
                $('#modalRegistro').modal('close');
                M.toast({ html: '<span>Registro correcto</span><button id="ver" class="btn-flat toast-action">Ver</button>', classes: 'rounded' });
                if (id > 0) {
                    console.log(response['data']);
                    setRow(response['data'], 'insert');
                    setRow(response['data'], 'delete');

                } else {
                    console.log(response['data']);
                    setRow(response['data'], 'insert');
                }
            } else {
                M.toast({ html: '<span>Error al guardar</span>', classes: 'rounded' });
            }
        },
        error: function (request, status, error) {

        }
    });
}
function setRow(data, action) {
    console.log(data);
    if (action === 'insert') {
        var row = table.row.add([
            data.pk,
            data.name,
            data.dom,
            data.sex,
            data.fecha,
            '<i class="material-icons edit" id-record="' + data.pk
            + '">create</i><i class="material-icons delete" id-record="' +
            data.pk + '">delete_forever</i>'
        ]).draw().node();
        $(row).attr('id', data.pk);
        students[data.pk] = {
            'id': data.pk,
            'nombre': data.name,
            'domicilio': data.dom,
            'sexo': data.sex,
            'fecha': data.fecha
        }
    }
    if (action === 'delete') {
        table.row('#' + data.pk).remove().draw();
    }
}
function cargaStudents() {
    var parametros = "";
    $.ajax({
        type: "post",
        url: "cargastudent.php",
        dataType: 'json',
        data: parametros,
        success: function (response) {
            if (response['status']) {
                //console.log(response['data']);
                students = response['data'];
            } else {
                students = null;
            }
        },
        error: function (request, status, error) {
            M.toast({ html: '<span>Error al obtener la lista de estudiantes</span>', classes: 'rounded' });
        }
    });
}

function deleteData(id) {
    boton = '&boton=Eliminar';
    var parametros = 'pk=' + id + boton;
    $.ajax({
        type: "post",
        url: 'actStudent.php',
        dataType: 'json',
        data: parametros,
        success: function (response) {
            if (response['status']) {
                M.toast({ html: '<span>Registro eliminado</span>', classes: 'rounded' });
                setRow(response['data'], 'delete');
            } else {
                M.toast({ html: '<span>Error al eliminar</span>', classes: 'rounded' });
            }
        },
        error: function (request, status, error) {
            M.toast({ html: '<span>Error al eliminar</span>', classes: 'rounded' });

        }
    });

}