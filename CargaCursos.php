<?php
include_once('./utilerias/BaseDatos.php');
$query='SELECT id_curso,titulo,descripcion,costo FROM curso ORDER BY titulo';
$cursos=Consulta($query);
foreach ($cursos as $tupla) {
    echo "
    <tr id='".$tupla['id_curso']."'>
        <td>".$tupla['titulo']."</td>
        <td>".$tupla['descripcion']."</td>
        <td>".$tupla['costo']."</td>
        <td>
        <i class='material-icons edit' id-record=".$tupla['id_curso'].">create</i>
        <i class='material-icons edit' id-record=".$tupla['id_curso'].">delete_forever</i>
        </td>
    </tr>";
}
?>