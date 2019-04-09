<?php
include_once('./controllers/controller_student.php');
$cargaCursos=new Student_controller();
echo $cargaCursos->getAllStudents();
?>