<?php
     include_once("./Utilerias/BaseDatos.php");
     $post = $_POST;
     if ($post["boton"]=="Agregar"){
          $res = AgregaCursito($post);
          echo '<prev>Actualizar:<br> '; print_r($res);echo '</prev>';
          $post['pk']=$res;
          $response["status"] = true;
          $response["data"] = $post;
        
          echo json_encode($response);
     }else if ($post["boton"]=="Actualizar"){
          $res = ActualizaCursito($post);
          echo '<prev>Actualizar:<br> '; print_r($res);echo '</prev>';
          $response["status"] = true;
          $response["data"] = $post;
          echo json_encode($response);
     }else if ($post["boton"]=="Eliminar"){
          $res = EliminaCursito($post);
          $response["status"] = true;
          $response["data"] = $post;

          echo json_encode($response);
     } 
     
?>