<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!--Import Google Icon Font
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">-->
    <!--Import materialize.css-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="./css/default.css">
    <link rel="icon" type="image/x-icon" href="./favicon.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Students</title>
</head>

<body>
    <div class="row">
        <div class="col s12 m8 offset-m2">
            <div class="card">
                <div class="fixed-action-btn">
                    <a id="add-record" class="btn-floating btn-large waves-effect waves-light right">
                        <i class=" material-icons">add</i>
                    </a></div>
                <div class="card-content">
                    <span>
                        <h3>Estudiantes</h3>
                    </span>
                    <table id="students" class="highlight bordered dataTable">
                        <thead>
                            <th>No. Control</th>
                            <th>Nombre</th>
                            <th>Domicilio</th>
                            <th>Sexo</th>
                            <th>Fecha de nacimiento</th>
                            <th>Acciones</th>
                        </thead>
                        <tbody>
                            <?php include_once('./controllers/controller_student.php');
                            $obj= new Student_controller();
                            $obj->fillTable();
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Ventana Modal-->
    <div class="modal" id="modalRegistro">
        <div class="modal-content">
            <h4 align="center">Alta y edición de cursos</h4>
            <br>
            <form id="frm-students" method="POST">
                <div class="row">
                    <div class="input-field col s12 m6">
                        <input type="text" name="pk" id="pk" value="0" hidden>
                        <input type="text" name="name" id="name" class="validate">
                        <label for="name">Nombre del alumno</label>
                    </div>
                    <div class="input-field col s12 m6">
                        <input type="text" name="dom" id="dom" class="validate">
                        <label for="dom">Domicilio</label>
                    </div>
                    <div class="input-field col s12 m6">
                        <select name="sex" id="sex">
                            <option value="h">Hombre</option>
                            <option value="m">Mujer</option>
                        </select>
                        <label for="sex">Sexo</label>
                    </div>
                    <div class="input-field col s12 m6">
                        <input type="text" id="fecha" name="fecha" class="datepicker validate">
                        <label for="fecha">Fecha de nacimiento</label>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">

            <button class="modal-action btn waves-effect waves-green btn-flat " id="guardar">Guardar</button>

        </div>

    </div>



    <!--JavaScript at end of body for optimized loading-->
    <script type="text/javascript" src="./js/jquery-3.0.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script type="text/javascript" src="./js/jquery.validate.min.js"></script>
    <script type="text/javascript" src="./js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="./js/dataTables.materialize.js"></script>
    <script type="text/javascript" src="resources/js/student.js"></script>



</body>

</html>