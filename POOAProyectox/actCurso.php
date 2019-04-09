<?php
include_once('controllers/controller_curso.php');
$ob=new Curso_controller();
$post = $_POST;
     if ($post["boton"]=="Agregar"){
         echo $ob->agregar($post);        
     }else if ($post["boton"]=="Actualizar"){
        echo $ob->actualizar($post);        
     }else if ($post["boton"]=="Eliminar"){
        echo $ob->eliminar($post);  
     } 
?>