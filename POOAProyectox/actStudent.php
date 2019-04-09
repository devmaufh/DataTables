<?php
include_once('controllers/controller_student.php');
$ob= new Student_controller();
$post = $_POST;
if ($post["boton"]=="Agregar"){
    //echo'</prev>';var_dump($post);echo'</prev>';
    //die();
    echo $ob->agregar($post);        
}else if ($post["boton"]=="Actualizar"){
    //echo'</prev>';var_dump($post);echo'</prev>';
    //die();
    echo $ob->actualizar($post);        
}else if ($post["boton"]=="Eliminar"){
    //echo'</prev>';var_dump($post);echo'</prev>';
    //die();
    echo $ob->eliminar($post);  
} 
?>