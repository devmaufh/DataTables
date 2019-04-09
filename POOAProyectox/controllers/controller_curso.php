<?php

class Curso_controller
{
    private $Cn;
    public function __construct() {
        require_once('utilerias/BaseDatos.php');
        $this->Cn=new Connection();
    }
    public function fillTable(){
        $query='SELECT id_curso,titulo,descripcion,costo FROM curso ORDER BY titulo';
        $cursos = $this->Cn->Consulta($query);
        foreach ($cursos as $tupla )
        {
            echo "<tr id='". $tupla['id_curso'] . "'>
                <td>" . $tupla['titulo'] . "</td>
                <td>" . $tupla['descripcion'] . "</td>
                <td>
                    <i class='material-icons edit' id-record='" . $tupla['id_curso'] . "'>create</i>
                    <i class='material-icons delete' id-record='". $tupla['id_curso'] . "'>delete_forever</i>
                </td>
            </tr>";
        } 

    }
  

    
    public function getAllCurses(){
        $query='SELECT * FROM curso ORDER BY titulo';
        $cursos=$this->Cn->Consulta($query);
        $data=array();
        $response=array();
        $response['status']=1;
        $response['data']=array();
        foreach ($cursos as $curso ) {
            $data[$curso['id_curso']]=$curso;
        }
        $response['data']=$data;
        return  json_encode($response);
    }
    
    public function testing(){
      echo   $this->Cn->Ejecuta('SELECT * FROM curso');
    }
    public function agregar($post){
        $res=$this->Cn->AgregaCursito($post);
        $post['pk']=$res;
        $response["status"] = true;
        $response["data"] = $post;
        return json_encode($response);
    }
    
    public function actualizar($post){
        $res =$this->Cn->ActualizaCursito($post);
       // echo '<prev>Actualizar:<br> '; print_r($res);echo '</prev>';
        $response["status"] = true;
        $response["data"] = $post;
        return json_encode($response);
    }
    public function eliminar($post){
        $res=$this->Cn->EliminaCursito($post);
        $response["status"]=true;
        $response["data"]=$post;
        return json_encode($response);
    }    
    public function actCurso($post){
        if($post["boton"]=="Agregar"){
            return $this->agregar($post);
        }else if($post["boton"]=="Actualizar"){
            return $this->actualizar($post);
        }else if($post["boton"]=="Eliminar"){
            return $this->eliminar($post);
        }
    }
}

?>