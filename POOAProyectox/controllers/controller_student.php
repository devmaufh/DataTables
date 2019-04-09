<?php
class Student_controller  
{
    private $Cn;
    public function __construct() {
        require_once('utilerias/BaseDatos.php');
        $this->Cn=new Connection();
    }
    public function fillTable(){
        $query='SELECT * from estudiante';
        $students=$this->Cn->Consulta($query);
        foreach($students as $student){
            echo "<tr>
                    <td>".$student['id']."</td>
                    <td>".$student['nombre']."</td>
                    <td>".$student['domicilio']."</td>
                    <td>".$student['sexo']."</td>
                    <td>".$student['fecha']."</td>
                    <td>
                        <i class='material-icons edit' id-record='" . $student['id'] . "'>create</i>
                        <i class='material-icons delete' id-record='". $student['id'] . "'>delete_forever</i>
                    </td>
                  </tr>";
        }
    }    
    public function getAllStudents(){
        $query='SELECT * FROM estudiante ';
        $cursos=$this->Cn->Consulta($query);
        $data=array();
        $response=array();
        $response['status']=1;
        $response['data']=array();
        foreach ($cursos as $curso ) {
            $data[$curso['id']]=$curso;
        }
        $response['data']=$data;
        return  json_encode($response);
    }
    
    public function testing(){
      echo   $this->Cn->Ejecuta('SELECT * FROM curso');
    }
    public function agregar($post){
        $res=$this->Cn->AddStudent($post);
        $post['pk']=$res;
        $response["status"] = true;
        $response["data"] = $post;
        return json_encode($response);
    }
    
    public function actualizar($post){
        $res =$this->Cn->UpdateStudent($post);
       // echo '<prev>Actualizar:<br> '; print_r($res);echo '</prev>';
        $response["status"] = true;
        $response["data"] = $post;
        return json_encode($response);
    }
    public function eliminar($post){
        $res=$this->Cn->DeleteStudent($post);
        $response["status"]=true;
        $response["data"]=$post;
        return json_encode($response);
    }        

}

?>