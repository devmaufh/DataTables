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
    <title>Document</title>
</head>

<body>
    <div class="row">
        <div class="col s12 m8 offset-m2">
            <div class="card">
                <a id="add_record" class="btn-floating btn-large waves-effect waves-light right ">
                    <i class="material-icons">add</i>
                </a>
                <div class="card-content">
                    <span><h3>Cursos</h3></span>
                    <table id="cur" class="hightlight bordered dataTable">
                        <thead>
                            <th>Titulo</th>
                            <th>Descripción</th>
                            <th>Costo</th>
                            <th></th>
                        </thead>
                        <tbody>
                            <?php include_once('CargaCursos.php') ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Ventana Modal-->
    <div class="modal" id="modalRegister">
        <div class="modal-content">
            <h4>Alta y edición de cursos</h4>
            <br>
            <form id="frm-cursos" method="POST">
                <div class="row">
                    <div class="input-field col s12 m12">
                        <input type="text" name="pk" id="pk" value="0">
                        <input type="text" name="tit" id="tit" class="validate">
                        <label for="tit">Titulo del curso</label>
                    </div>
                    <div class="input-field col s12 m12">
                        <input type="text" name="descript" id="descrip" class="validate">
                        <label for="descrip">Descripción del curso</label>
                    </div>
                    <div class="input-field col s12 m12">
                        <input type="text" name="cost" id="cost" class="validate">
                        <label for="cost">Costo del curso</label>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <a id="guardar" class="modal-action waves-effect waves-green btn-flat">Guardar</a>
        </div>
    </div>
    <!--JavaScript at end of body for optimized loading-->
    <script type="text/javascript" src="./js/materialize.min.js"></script>
    <script src="./js/jquery-2.1.1.min.js"></script>
    <script src="./js/new.js"></script>
    <script src="./js/jquery.validate.min.js"></script>
    <script src=".resources/js/Cursos.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/dataTables.materialize.js"></script>
    <script src="js/dataTables.responsive.min.js"></script>
    <script src="js/dataTables.materialize.js"></script>
    <script src="js/dataTables.fixedColumns.min.js"></script>
</body>

</html>