<?php
//---------------------------------------------------------------------
// Utilerias de Bases de Dato
// Alejandro Guzmán Zazueta
// Enero 2019
//---------------------------------------------------------------------
try{
       // $Cn = new PDO('mysql:host=localhost; dbname=bdalumnos','root','');
        $Cn = new PDO('pgsql:host=localhost;port=5432;dbname=SAS_DEMO;user=postgres;password=hola');
        $Cn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //$Cn->exec("SET CHARACTER SET utf8");
        $Cn->exec("SET CLIENT_ENCODING TO 'UTF8';");
}catch(Exception $e){
    die("Error: " . $e->GetMessage());
}

// Función BuscaAvisos del usuario
function getAllCursos()
{
    global $Cn;
    try{
        $sql = 'SELECT id_curso,titcurso,descripcurso FROM curso ORDER BY titcurso';    
        $result =$Cn->prepare($sql);
        //$result->execute(array(":exi"=>21));
        $result->execute(array());
        $resultado = $result->fetchAll(PDO::FETCH_ASSOC); 
        $result->closeCursor();
        return $resultado;
    }catch(Exception $e){
        die("Error en la LIN: " . $e->getLine() . ", MSG: " . $e->GetMessage());
    }
}

function insertarCurso($post){
    global $Cn;
        try{
            $sql = 'INSERT INTO curso (titulo,descripcion) VALUES (:tit, :descrip)';
            $result =$Cn->prepare($sql);
            $result->execute(array(":tit"=>$post['tit'], ":descrip"=>$post['descrip']));
            $result->closeCursor();
            return 1;
        }catch(Exception $e){
            die("Error en la LIN: " . $e->getLine() . ", MSG: " . $e->GetMessage());
        }        
return $insert;
}


// Función AppAvisos
//function buscaAvisosSE()
//{
//    global $Cn;
//    $sql = "SELECT A.usrId,idAviso, titulo, descripcion, A.usrIdTUTOR, fechaFin, 1 'idTipoUsr', //estado, imagen, A.fechaAlta  from aviso A Inner Join usuario B On (A.usrId = B.usrId) WHERE fechaFin //>= NOW() and B.idTipoUsr = 1 order by A.usrId, idAviso desc";    
//    return $Cn->query($sql);
//}

// Función BuscaAvisos del usuario
function buscaAvisosUsuario($usr)
{
    global $Cn;
    //$sql = "SELECT usrId, idAviso, titulo, descripcion, A.usrIdTutor, fechaFin, 2 'idTipoUsr', //estado, imagen, fechaAlta  from aviso A WHERE fechaFin >= NOW() and usrId = '{$usr}' order by //usrId, idAviso desc";    
    $sql = "SELECT A.usrId,idAviso, titulo, descripcion, A.usrIdTUTOR, fechaFin, idTipoUsr, estado, imagen, A.fechaAlta  from aviso A Inner Join usuario B On (A.usrId = B.usrId) WHERE fechaFin >= NOW() and A.usrId = '{$usr}' and estado <> 'B' order by A.usrId, idAviso desc";
    return $Cn->query($sql);
}

//------------- Contactos-----------------------
function buscaContactos($corr)
{
    global $Cn;
    $sql = "SELECT Correo, idContacto,NomContacto,DomContacto,Cp,CorContacto,TelCasa, TelCelular, recFecha, Estado, FechaAlta From Contacto where correo='{$corr}' order by idContacto";
    return $Cn->query($sql);
}

function recuperaCorreo($corr)
{
    global $Cn;
    $sql = "SELECT correo,contrasena From registro where correo='{$corr}'";
    return $Cn->query($sql);
}

function buscaUsuario($usr,$pwd)
{
    global $Cn;
    $sql = "SELECT * From usuario where idTipoUsr in (1,2) and usrId = '{$usr}' and pwd = '{$pwd}'";    
    return $Cn->query($sql);
}

// Función para buscar un usuario a registrar verificando su usuario y contraseña
// solo para Tipos de Usuario 1= Serv Escolares y 2 = Tutores
function buscaRegistro($usr,$pwd)
{
	global $Cn;
	$sql = "SELECT * From usuario where idTipoUsr in (1,2) and usrId = '{$usr}' and pwd = '{$pwd}'";
	$res = $Cn->query($sql);
    if ($tupla = $res->fetch_assoc())
    {
        return 1;
    }
    else
    {
        return 0;
    }
}

function agregarRegistro($usr, $cor, $tel, $con)
{
    global $Cn;
    if (buscaRegistro($usr, $con) == 0)
    {
        return 23; // No se encontro el susuario
    }
    else
    {
        $sql = "UPDATE usuario SET noTel= '{$tel}', correo='{$cor}', fechaAlta=NOW() WHERE usrId='{$usr}'";
        return $Cn->query($sql);
    }
}

function idAviso ($usr)
{
    global $Cn;
    $sql = "SELECT IFNULL(Max(idAviso)+1,2) 'idAviso' From aviso where usrId = '{$usr}'";
	$res = $Cn->query($sql);
   if ($tupla = $res->fetch_assoc())
    {
        return $tupla['idAviso'];
    }
}

function RespaldaAviso($usrId,$idA,$tit,$descrip,$fecF,$ed,$feca)
{
    global $Cn;
    
    if ($ed == 'A'){
       $idAviso = idAviso($usrId);    
       $sql = "Insert into aviso (usrId,idAviso,titulo,descripcion,fechaFin,FechaAlta,Estado) values ('{$usrId}','{$idAviso}','{$tit}','{$descrip}','{$fecF}','{$feca}','G')";  
    }
    else
    {
        if ($ed == 'B')
        {
            $sql = "Update aviso set Estado='B' where usrId='{$usrId}' and idAviso='{$idA}'";
        }
        else
        {
            if ($ed == 'C')
            {
                $sql = "Update aviso Set titulo='{$tit}', descripcion='{$descrip}', fechaFin='{$fecF}', Estado ='G', FechaAlta='{$feca}' where usrId='{$usrId}' and idAviso='{$idA}'";
            }
            else
                return 1;
        }
    }     
    return $Cn->query($sql);
}

function obj2array($obj) {
  $out = array();
  foreach ($obj as $key => $val) {
    switch(true) {
        case is_object($val):
         $out[$key] = obj2array($val);
         break;
      case is_array($val):
         $out[$key] = obj2array($val);
         break;
      default:
        $out[$key] = $val;
    }
  }
  return $out;
} 
