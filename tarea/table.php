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
        <div class="fixed-action-btn">
                <a id="add_record" href="form.php"class="btn-floating btn-large waves-effect waves-light left" >
                    <i class="material-icons">arrow_back</i>
                </a>
        </div>
        <div class="container ">
            <div class="row">
      

            <?php
            include_once('./utilerias/BaseDatos.php');
            include_once('./product_model.php');
            $tuplas=Consulta("Select * from productos order by id DESC");
            ?>
                <div class="card-panel">
                <div class="input-field col s12 m12">
                        <Select id="tipo" name="tipo">
                            <option value="0"  selected>Todos</option>
                            <option value="1" >Herramientas</option>
                            <option value="2" >Pinturas</option>                              
                        </Select>
                    </div>

                <table class=" striped centered" id="list" name="list">
                    <thead class="teal lighten-2 white-text">
                        <th>No</th>
                        <th>Nombre</th>
                        <th>Existencia</th>
                        <th>Precio</th>
                        <th>Costo</th>
                        <th>imagen</th>
                    </thead>
                    <tbody>
                        <?php foreach ($tuplas as $tupla) {
                            echo "
                            <tr>
                                   <td>".$tupla['id']."</td>
                                   <td>".$tupla['nombre']."</td>
                                   <td>".$tupla['existencia']." units</td>
                                   <td>$".$tupla['precio']."</td>
                                   <td>$".$tupla['costo']."</td>
                                   <td> <img src='".$tupla['imagen']."' height='100px'></td>
                             </tr>";
                            }?>

                    </tbody>
                </table></div>
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
        <script src="./resources/js/products.js"></script>

    </body>

</html>