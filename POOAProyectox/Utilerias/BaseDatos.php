<?php
/*---------------------------------------------------------------------------------------------------------------------
        Acceso a base de datos postgresql
        Mauricio Flores Hernández 22/03/19
---------------------------------------------------------------------------------------------------------------------*/
class Connection  
{
    private $Cn;
    public function __construct() {
        try {
            $this->Cn=new PDO("pgsql:host=127.0.0.1;port=5432;dbname=escuelas;user=postgres;password=12345678");
            $this->Cn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->Cn->exec("SET CLIENT_ENCODING TO 'UTF8';");
        } catch(Exception $e) {
            die("Error: ".$e);
        }
    }
    public function Consulta($query)
    {
        try {
            $result=$this->Cn->query($query);
            $resultado=$result->fetchAll(PDO::FETCH_ASSOC);
            $result->closeCursor();
            return $resultado;
        }catch(Exception $e) {
            die("Error: ".$e.GetMessage());
        }           
    }
    public function Ejecuta($sentencia){
        try{
            $result =$this->Cn->query($sentencia);
            $result->closeCursor();
            return 1;
        }catch(Exception $e){
            die("Error en la LIN: " . $e->getLine() . ", MSG: " . $e->GetMessage());
        }        
        return $insert;        
    }
    public function EjecutaConsecutivo($sentencia){
        try{
            $result =$this->Cn->query($sentencia);
            $resultado = $result->fetchAll(PDO::FETCH_ASSOC);
            $result->closeCursor();
            return $resultado[0]["id_curso"];
        }catch(Exception $e){
            //die("Error en la LIN: " . $e->getLine() . ", MSG: " . $e->GetMessage());
            return 0;
        }        
        return $insert;
    }
    public function AgregaCurso($post)
    {
        $tit = $post['tit'];
        $des = $post['descrip'];
        $sentencia = 'INSERT INTO curso(titulo,descripcion) VALUES (' . "'{$tit}', '{$des}') RETURNING id_curso";
        return $this->EjecutaConsecutivo($sentencia);
    }

    public function AgregaCursito($post)
    {
        try {
            $sentencia = 'INSERT INTO curso(titulo,descripcion) VALUES (:tit, :des) RETURNING id_curso';
            $res = $this->Cn->prepare($sentencia);
            $res->execute(array(":tit"=>$post['tit'], ":des"=>$post['descrip']));
            $resultado = $res->fetchAll(PDO::FETCH_ASSOC);
            $res->closeCursor();
            return $resultado[0]["id_curso"];

        }catch(Exception $e){
            die("Error en la LIN: " . $e->getLine() . ", MSG: " . $e->GetMessage());
        }       
    }
    public function AddStudent($post)
    {
        try {
            $query='INSERT INTO estudiante(nombre, domicilio,sexo,fecha) VALUES'."(:name,:dom,:sex,:date) RETURNING id";
            $res=$this->Cn->prepare($query);
            $res->execute(array(":name"=>$post['name'], ":dom"=>$post['dom'], ":sex"=>$post['sex'], ":date"=>$post['fecha']));
            $resultado = $res->fetchAll(PDO::FETCH_ASSOC);
            $res->closeCursor();
            return $resultado[0]["id"];
        } catch (Exception $e) {
            die("Error en la LIN: " . $e->getLine() . ", MSG: " . $e->GetMessage());
        }
    }
    public function ActualizaCurso($post)
    {
        $id = $post['pk'];
        $tit = $post['tit'];
        $des = $post['descrip'];
        $sentencia = 'UPDATE curso Set titulo=' . "'{$tit}',  \ descripcion='{$des}' where id_curso=$id";
        //echo $sentencia;
        //die("WWW");
        return $this->Ejecuta($sentencia);
    }
    public function ActualizaCursito($post)
    {
        try {
            $sentencia = 'UPDATE curso Set titulo=:tit,  descripcion=:des WHERE id_curso=:id';
            $res = $this->Cn->prepare($sentencia);
            $res->execute(array(":tit"=>$post['tit'], ":des"=>$post['descrip'], ":id"=>$post['pk']));
            $res->closeCursor();
            return 1;
        }catch(Exception $e){
            die("Error en la LIN: " . $e->getLine() . ", MSG: " . $e->GetMessage());
        }       
    }
    public function UpdateStudent($post)
    {
        try {
            $sentencia = 'UPDATE estudiante Set nombre=:name,domicilio=:dom,sexo=:sex, fecha=:date WHERE id=:id';
            $res = $this->Cn->prepare($sentencia);
            $res->execute(array(":name"=>$post['name'], ":dom"=>$post['dom'], ":sex"=>$post['sex'], ":date"=>$post['fecha'], ":id"=>$post['pk']));
            $res->closeCursor();
            return 1;
        }catch(Exception $e){
            die("Error en la LIN: " . $e->getLine() . ", MSG: " . $e->GetMessage());
        }       
        
    }
    function EliminaCurso($post)
    {
        $id = $post['pk'];

        $sentencia = 'DELETE FROM curso WHERE id_curso=' . $id;
        //echo $sentencia;
        //die("WWW");
        return $this->Ejecuta($sentencia);
    }

    public function EliminaCursito($post)
    {
        try {
            $sentencia = 'DELETE FROM curso  WHERE "id_curso"=:id';
            $res = $this->Cn->prepare($sentencia);
            $res->execute(array(":id"=>$post['pk']));
            $res->closeCursor();
            return 1;
        }catch(Exception $e){
            die("Error en la LIN: " . $e->getLine() . ", MSG: " . $e->GetMessage());
        }   
    }
    public function DeleteStudent($post)
    {
        try {
            $sentencia = 'DELETE FROM estudiante  WHERE id=:id';
            $res = $this->Cn->prepare($sentencia);
            $res->execute(array(":id"=>$post['pk']));
            $res->closeCursor();
            return 1;
        }catch(Exception $e){
            die("Error en la LIN: " . $e->getLine() . ", MSG: " . $e->GetMessage());
        }  
    }
}

?>