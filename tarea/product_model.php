<?php
include_once('./utilerias/BaseDatos.php');
include_once('./utilerias/upload_files.php');
class Model_producto  
{
    private $id;
    private $name;
    private $existence;
    private $cost;
    private $pricing;
    private $image;
    private $idcategoria;
    public function __construct($name,$existence,$cost,$pricing,$image,$idcategoria) {
        $this->name=$name;
        $this->existence=$existence;
        $this->cost=$cost;
        $this->pricing=$pricing;
        $this->image=$image;
        $this->idcategoria=$idcategoria;
    }
    public function set_id($id)
    {
        $this->id=$id;
    }
    public function get_id()
    {
        return $this->id;
    }
    public function get_name(){
        return $this->name;
    }
    public function get_existence(){
        return $this->existence;
    }
    public function get_cost(){
        return $this->cost;
    }
    public function get_pricing(){
        return $this->pricing;
    }
    public function get_image()
    {
        return $this->image;
    }
    public function get_idcategoria(){
        return $this->idcategoria;
    }
}
class Controller_producto  
{
    public static function insert($producto){
        $query="insert into productos(nombre, existencia, precio,costo,imagen,id_clasificacion) values('".$producto->get_name()."',".$producto->get_existence().",".$producto->get_pricing().",".$producto->get_cost().",'".$producto->get_image()."', ".$producto->get_idcategoria().")";
        //echo '<prev>'; print_r($query);echo'</prev>';
        $result=Consulta($query);
    }
}
if(isset($_POST['name']) && $_POST['existence']&& $_POST['price']&& $_POST['cost'] && $_POST['tipo']){
    $tipo=$_POST['tipo'];
    $name=$_POST['name'];
    $existence=$_POST['existence'];
    $price=$_POST['price'];
    $cost=$_POST['cost'];
    $ruta=Utils::uploadImage();
    $producto=new Model_producto($name,$existence,$cost,$price,$ruta,$tipo);
    Controller_producto::insert($producto);
}


?>