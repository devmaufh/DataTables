<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!--Import Google Icon Font
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">-->
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="./css/materialize.min.css" media="screen,projection" />
    <link rel="stylesheet" href="./css/default.css">
    <link rel="icon" type="image/x-icon" href="./favicon.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tabla</title>
</head>
<body>
    <section>
        <div class="container ">
            <div class="row">
            <?php
            include_once('./utilerias/BaseDatos.php');
            $tuplas=Consulta("Select * from curso");
            ?>
                <table class="highlight">
                    <thead>
                        <th>idcurso</th>
                        <th>titcurso</th>
                        <th>descurso</th>
                        <th>costo</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Material Design 2.0</td>
                            <td>Curso de material design version 2 by Google </td>
                            <td>$989</td>
                        </tr>
                        <?php foreach ($tuplas as $tupla) {
                               echo "
                            <tr id='".$tupla['id_curso']."'>
                                   <td>".$tupla['id_curso']."</td>

                                   <td>".$tupla['titulo']."</td>
                                   <td>".$tupla['descripcion']."</td>
                                   <td>".$tupla['costo']."</td>
                                   <td>  </td>
                             </tr>";
                            }?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <body>
        <!--JavaScript at end of body for optimized loading-->
        <script type="text/javascript" src="./js/materialize.min.js"></script>
        <script src="./js/jquery-2.1.1.min.js"></script>
        <script src="./js/new.js"></script>
        <script src="./js/jquery.validate.min.js"></script>
        <script src="./resources/js/Cursos.js"></script>
        <script src="./js/jquery.dataTables.min.js"></script>
        <script src="./js/dataTables.materialize.js"></script>
        <script src="./js/dataTables.responsive.min.js"></script>
        <script src="./js/dataTables.materialize.js"></script>
        <script src="./js/dataTables.fixedColumns.min.js"></script>
    </body>

</html>