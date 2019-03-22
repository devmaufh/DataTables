<?php
/*---------------------------------------------------------------------------------------------------------------------
        Acceso a base de datos postgresql
        Mauricio Flores Hernández 22/03/19
---------------------------------------------------------------------------------------------------------------------*/
try {
    $Cn=new PDO("pgsql:host=127.0.0.1;port=5432;dbname=escuelas;user=postgres;password=12345678");
    $Cn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $Cn->exec("SET CLIENT_ENCODING TO 'UTF8';");
} catch(Exception $e) {
    die("Error: ".$e);
}
/* Función para validar */
function Consulta($query)
{
    global $Cn;
    try {
        $result=$Cn->query($query);
        $resultado=$result->fetchAll(PDO::FETCH_ASSOC);
        $result->closeCursor();
        return $resultado;
    }catch(Exception $e) {
        die("Error: ".$e.GetMessage());
    }   
}

?>