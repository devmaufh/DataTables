<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link type="text/css" rel="stylesheet" href="./css/materialize.min.css" media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="./css/dataTables.materialize.css"/>
    <link type="text/css" rel="stylesheet" href="./css/default.css"/>
    <link rel="icon" type="image/x-icon" href="./fonts/favicon.ico" />
</head>
<body>
    <div class="row">
        <div class="col s12 m8 offset-m2">
            <div class="card">
                <a id="add-record" class="btn-floating btn-large waves-effect waves-light right" >
                    <i class="material-icons">add</i>
                </a>
                <div class="card-content">
                    <span><h3>Cursos</h3></span>
                    <table id="cur" class="responsive-table highlight bordered dataTable">
                        <thead>
                           <tr><th>Título del Curso</th><th>Descripción del Curso</th><th></th></tr>
                        </thead>
                        <tbody>
                            <?php
                                include_once("CargaCursos.php");
                            ?>
                            <!--
                           {% for curso in cursos %}
                                <tr id="{{ curso['idcurso'] }}">
                                    <td>{{  curso['titcurso']  }}</td>
                                    <td>{{  curso['descripcurso']  }}</td>
                                    <td>
                                        <i class="material-icons edit" id-record="{{ curso['idcurso'] }}">create</i>
                                        <i class="material-icons delete" id-record="{{ curso['idcurso'] }}">delete_forever</i>
                                    </td>
                                </tr>   
                           {% endfor %}
                           -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
   <!-- Ventana Modal -->
   <div class="modal" id="modalRegistro">
       <div class="modal-content">
           <h4>Alta y Edición de Cursos</h4>
           <br>
           <form id="frm-cursos" method="post">
              <div class="row">
                   <div class="input-field col s12">
                       <input  type="text" id="pk" name="pk" value="0">
                       <input type="text" id="tit" name="tit" class="validate">
                       <label for="tit">Título del Curso</label>
                   </div>
                   <div class="input-field col s12">
                       <input type="text" id="descrip" name="descrip" class="validate">
                       <label for="descrip">Descripción del curso</label>
                   </div>
             </div>
           </form>
       </div>
       <div class="modal-footer">
           <a id="guardar" class="modal-action waves-effect waves-green btn-flat" >Guardar</a>
       </div>
   </div>

    <script type="text/javascript" src="./js/jquery-3.0.0.min.js"></script>
    <script type="text/javascript" src="./js/materialize.min.js"></script> 
    <script type="text/javascript" src="./js/jquery.validate.min.js"></script>        
    <script type="text/javascript" src="./js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="./js/dataTables.materialize.js"></script>
    <script type="text/javascript" src="./resources/js/Cursos.js">    </script> 



</body>
</html>