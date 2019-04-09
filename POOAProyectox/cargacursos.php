<?php
include_once('./controllers/controller_curso.php');
$cargaCursos=new Curso_controller();
echo $cargaCursos->getAllCurses();
?>