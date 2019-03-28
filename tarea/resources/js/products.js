var products=null;

$('#tipo').change(function(){
    var option=$(this).children("option:selected").val()
    selectByCat(option);
});
function selectByCat(cat){
    var params={
        "category":cat
    };
    $.ajax({
        data: params,
        url:"getByCat.php",
        dataType: "json",
        type: "post",
        success: function (response){
            if(response['status']){
                products=response['data'];
                console.log(products);
                fill_table(products);
            }else{
                products=null;
            }
        },
        error: function(request,status, error){
            Materialize.toast('Error al cargar el arreclo Cursos',5000);
        }
    });
}

function fill_table(products) {
    var table=$('#list tbody');
    table.remove();
    table=$('#list');
    $.each(products,function(i,product){
        table.append("<tr><td>"+i+"</td><td>"+products[i].nombre+"</td><td>"+products[i].existencia+"</td><td>"+products[i].precio+"</td><td>"+products[i].costo+"</td><td> <img src='./"+products[i].imagen+"' height='100px'></td></tr>");
    });
}