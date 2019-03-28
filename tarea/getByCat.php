<?php
include_once('./utilerias/BaseDatos.php');
$id=$_POST['category'];
if($id==0){
    $query="SELECT * from productos";

}else{
    $query="SELECT * from productos WHERE id_clasificacion=$id";
}
$productos=Consulta($query);
$data=array();
$response['status']=1;
$response["data"]=array();
foreach ($productos as $producto) {
    $data[$producto['id']]=$producto;
}
$response['data']=$data;
echo json_encode($response);
?>