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
    <div class="section container">
        <h3 class="teal-text" align="center">Registrar producto</h3>
        <div class="row">
            <form class="col s12" action="table.php" method="POST" id="form1" enctype="multipart/form-data">
                <div class="row card-panel">
                    <div class="input-field col s12 m6">
                        <input type="text" name="name" id="name" required>
                        <label for="name">Nombre</label>
                    </div>
                    <div class="input-field col s12 m6">
                        <Select id="tipo" name="tipo" require>
                            <option value="0" disabled selected>Selecciona una opción</option>
                            <option value="1" >Herramientas</option>
                            <option value="2" >Pinturas</option>
                        </Select>
                    </div>
                    
                    <div class="input-field col s12 m3">
                        <input type="number" name="existence" id="existence" required>
                        <label for="existence">Existencia</label>
                    </div>
                    <div class="input-field col s12 m3">
                        <input type="number" name="price" id="price" required>
                        <label for="price">Precio</label>
                    </div>
                    <div class="input-field col s12 m3">
                        <input type="number" name="cost" id="cost" required>
                        <label for="cost">Costo</label>
                    </div>
                    <div class="file-field input-field col s12 m3">
                    <div class="btn">
                            <span>File</span>
                            <input type="file" id="img" name="img">
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate" type="text">
                        </div>
                    </div>

                    <div class="col s12 m12" align="right">
                        <button type="submit" name="submit"  class="btn waves-effect waves-light">
                            Enviar
                        </button>
                    </div>   
                                     
                </div>
            </form>
            <div class="fixed-action-btn">
                <a id="add_record" href="table.php"class="btn-floating btn-large waves-effect waves-light left" >
                    <i class="material-icons">navigate_next</i>
                </a>
        </div>
        </div>
    </div>
    <!--JavaScript at end of body for optimized loading-->
    <script type="text/javascript" src="./js/materialize.min.js"></script>
    <script src="./js/jquery-2.1.1.min.js"></script>
    <script src="./js/jquery.validate.min.js"></script>
    <script src="./RegistroVal.js"></script>
    <script src="js/new.js"></script>
</body>

</html>