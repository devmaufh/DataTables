<?php
//---------------------------------------------------------------------
// Utilerias de Bases de Dato
// Alejandro Guzmán Zazueta
// Enero 2019
//---------------------------------------------------------------------

try{
    $Cn=new PDO("pgsql:host=127.0.0.1;port=5432;dbname=escuelas;user=postgres;password=12345678");
    $Cn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //$Cn->exec("SET CHARACTER SET utf8");
    $Cn->exec("SET CLIENT_ENCODING TO 'UTF8';");
}catch(Exception $e){
    die("Error: " . $e->GetMessage());
}

// Función para ejecutar consultas SELECT
function Consulta($query)
{
    global $Cn;
    try{    
        $result =$Cn->query($query);
        $resultado = $result->fetchAll(PDO::FETCH_ASSOC); 
        $result->closeCursor();
        return $resultado;
    }catch(Exception $e){
        die("Error en la LIN: " . $e->getLine() . ", MSG: " . $e->GetMessage());
    }
}

//Función para mandar ejecutar un INSERT,UPDATE o DELETE
function Ejecuta($sentencia){
    global $Cn;
        try{
            $result =$Cn->query($sentencia);
            $result->closeCursor();
            return 1;
        }catch(Exception $e){
            die("Error en la LIN: " . $e->getLine() . ", MSG: " . $e->GetMessage());
        }        
return $insert;
}

//Función que manda ejecutar un INSERT regresando el consucutivo
function EjecutaConsecutivo($sentencia){
    global $Cn;
        try{
            $result =$Cn->query($sentencia);
            $resultado = $result->fetchAll(PDO::FETCH_ASSOC);
            $result->closeCursor();
            return $resultado[0]["id_curso"];
        }catch(Exception $e){
            //die("Error en la LIN: " . $e->getLine() . ", MSG: " . $e->GetMessage());
            return 0;
        }        
return $insert;
}
//-------------------------------------------------------------------
function AgregaCurso($post)
{
    global $Cn;
    $tit = $post['tit'];
    $des = $post['descrip'];
    $sentencia = 'INSERT INTO curso(titulo,descripcion) VALUES (' . "'{$tit}', '{$des}') RETURNING id_curso";
    return EjecutaConsecutivo($sentencia);
}

function AgregaCursito($post)
{
    try {
        global $Cn;
        $sentencia = 'INSERT INTO curso(titulo,descripcion) VALUES (:tit, :des) RETURNING id_curso';
        $res = $Cn->prepare($sentencia);
        $res->execute(array(":tit"=>$post['tit'], ":des"=>$post['descrip']));
        $resultado = $res->fetchAll(PDO::FETCH_ASSOC);
        $res->closeCursor();
        return $resultado[0]["id_curso"];

    }catch(Exception $e){
        die("Error en la LIN: " . $e->getLine() . ", MSG: " . $e->GetMessage());
    }       
}


function ActualizaCurso($post)
{
    global $Cn;
    $id = $post['pk'];
    $tit = $post['tit'];
    $des = $post['descrip'];
    $sentencia = 'UPDATE curso Set titulo=' . "'{$tit}',  \ descripcion='{$des}' where id_curso=$id";
    //echo $sentencia;
    //die("WWW");
    return Ejecuta($sentencia);
}

function ActualizaCursito($post)
{
    try {
        global $Cn;
        $sentencia = 'UPDATE curso Set titulo=:tit,  descripcion=:des WHERE id_curso=:id';
        $res = $Cn->prepare($sentencia);
        $res->execute(array(":tit"=>$post['tit'], ":des"=>$post['descrip'], ":id"=>$post['pk']));
        $res->closeCursor();
        return 1;
    }catch(Exception $e){
        die("Error en la LIN: " . $e->getLine() . ", MSG: " . $e->GetMessage());
    }       
}

function EliminaCurso($post)
{
    global $Cn;
    $id = $post['pk'];

    $sentencia = 'DELETE FROM curso WHERE id_curso=' . $id;
    //echo $sentencia;
    //die("WWW");
    return Ejecuta($sentencia);
}

function EliminaCursito($post)
{
    try {
        global $Cn;
        $sentencia = 'DELETE FROM curso  WHERE "id_curso"=:id';
        $res = $Cn->prepare($sentencia);
        $res->execute(array(":id"=>$post['pk']));
        $res->closeCursor();
        return 1;
    }catch(Exception $e){
        die("Error en la LIN: " . $e->getLine() . ", MSG: " . $e->GetMessage());
    }
    
}