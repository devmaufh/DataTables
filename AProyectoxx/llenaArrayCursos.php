<?php
    include_once('./Utilerias/BaseDatos.php');
    $query = 'SELECT id_curso,titulo,descripcion,costo FROM curso ORDER BY titulo';
    $cursos = Consulta($query);
    $data=array();
    $response=array();
    $response['status']=1;
    $response["data"] = array();
    foreach ($cursos as $tupla )
    {
        $data[$tupla['id_curso']] = $tupla;
    } 
    $response['data']=$data;
    //$result = json_encode($response);
    //echo('<pre>');
    //print_r($result);   // otra opción var_dump($result);
    //echo('</pre>');
    //die('X_x');
    echo json_encode($response);
?>