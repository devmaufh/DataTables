$(init)
var table=null;
var cursos=null;

function init() {
    table=$("#cur").DataTable({
        responsive:true,
        "aLengthMenu":[[10,25,50,75,100],[10,25,50,75,100]],
        "iDisplaylength":15, 
    });

    //cargaCursos();



    $('#guardar').on("click", function () {
        $('#frm-cursos').submit()
    });
}
$("#frm-cursos").validate({
    rules: {
        tit:{required:true, minlength:8,maxlength:60},
        descript:{required:true,minlength:8,maxlength:126},
        cost:{required:true,number:true},
       
    },
    messages: {
        tit:{required:"Necesitas este campo", minlength:"Debes ingresar al menos 8 caracteres",maxlength:"No puedes exceder los 60 caracteres"},
        descript:{required:"No puedes dejar este campo vacio",minlength:"Debes ingresar al menos 8 caracteres",maxlength:"No puedes exceder los 126 caracteres"},
        cost:{required:"Este campo es requerido",number:"Este campo debe ser numérico"},            
    },
    errorElement: "div",
    errorClass: "invalid",
    errorPlacement: function(error, element){
        error.insertAfter(element)                
    },
    submitHandler: function(form){
        saveData();
    }
});   

function saveData() {
    alert("Datos correctos");    
}

function cargaCursos(){
    var parametros="";
    $.ajax({
        type:"post",
        url:"CargaCursos.php",
    });
}