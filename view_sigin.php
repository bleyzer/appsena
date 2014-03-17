<?php
session_start();
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../assets/ico/favicon.ico">

    <title>Signin Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/recetas.css" rel="stylesheet">
    <link href="css/estilos.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <script type="text/javascript">

    function msg () {
      alert("La receta ha sido guardada con exito!");
    }

    </script>

<?php
 if(!empty($_SESSION['id'])) 
 { 
 ?>

    <div class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand" href="index.html">Supera el cancer</a>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="view_sigin.php">Home</a></li>
            <li><a href="recetasAdmin.php">Recetas</a></li>
            <li><a href="controller_sigin.php?opcion=salir">Salir</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>
    <br>

    <!-- Menú de comidas/bebidas debajo de la barra de navegación -->
    <div class="container text-center top-buffer">


      <!-- Comienzo del modal Añadir nueva receta-->
     
        <a class="btn btn-info" data-toggle="modal" href='#modal-añadir'>Añadir</a>
        <div class="modal fade" id="modal-añadir">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Añadir</h4>
              </div>
              <div class="modal-body">

                <!--codigo php para añadir recetas -->

                <?php
                $action = isset($_POST['action']) ? $_POST['action'] : "";

                if($action=='create'){
                  //include database connection
                  include 'libs/db_connect.php';

                  try{
                  
                    //write query
                    $query = "INSERT INTO recetas SET nombre = ?, ingredientes = ?, preparacion = ?, categoria = ?, imagen = ?;";

                    //prepare query for excecution
                    $stmt = $con->prepare($query);

                    //bind the parameters
                    //this is the first question mark
                    $stmt->bindParam(1, $_POST['nombre']);

                    //this is the second question mark
                    $stmt->bindParam(2, $_POST['ingredientes']);

                    //this is the third question mark
                    $stmt->bindParam(3, $_POST['preparacion']);

                    //this is the fourth question mark
                    $stmt->bindParam(4, $_POST['categoria']);

                    $stmt->bindParam(5, $_FILES['imagen']['name']);

                    //Ruta para guardar las imagenes
                    $directorio = $_SERVER['DOCUMENT_ROOT'].'/cancerv1/'.'imagenes/';

                  //RECIBIENDO DATOS IMAGEN
                    $nombreImg = $_FILES['imagen']['tmp_name'];
                    $tipoImg = $_FILES['imagen']['type'];
                    $tamanio = $_FILES['imagen']['size'];           

                  //MOVIENDO LA IMAGEN DESDE SU UBICACION TEMPORAL A SU DIRECTORIO DIFINITIVO
                    if (move_uploaded_file($nombreImg, $directorio.$_FILES['imagen']['name'])) {
                      echo "Se copio";
                    }
                    else{
                      echo "Error no se pudo copiaar";
                    } 
                    // Execute the query
                    if($stmt->execute()){


                      echo '

                      <script lenguaje="text/javascript">
                        msg();
                      </script>

                      ';



                    }else{
                      die('Unable to save record.');
                    }
                    
                  }catch(PDOException $exception){ //to handle error
                    echo "Error: " . $exception->getMessage();
                  }
                }

                ?>

                <!--Aqui termina el codigo para añadir recetas -->

                  
                  <!--Abre formulario dentro del modal-->
                  <div class="form-group"> 

                    <div class="row">   
                      <form action="#" method="POST" enctype="multipart/form-data"> 

                        <h2>Nueva Receta!</h2><br>
                        <div class="row">
                          <div class="col-md-3"></div>
                          <div class="col-md-2"><h4>Nombre: </h4></div>
                          <div class="col-md-1"></div>
                          <div class="col-md-3"><input type="text" name="nombre" placeholder="Nombre..."></div>
                          <div class="col-md-3"></div>
                        </div>
                                <br>
                        <div class="row">
                          <div class="col-md-3"></div>
                          <div class="col-md-2"><h4>Ingredientes: </h4></div>
                          <div class="col-md-1"></div>
                          <div class="col-md-4"><textarea class="form-control" name="ingredientes" rows="5" placeholder="Ingredientes..."></textarea></div>
                          <div class="col-md-2"></div>
                        </div>
                                <br>
                        <div class="row">
                          <div class="col-md-3"></div>
                          <div class="col-md-2"><h4>Preparación: </h4></div>
                          <div class="col-md-1"></div>
                          <div class="col-md-4"><textarea class="form-control" name="preparacion" rows="5" placeholder="Preparación..."></textarea></div>
                          <div class="col-md-2"></div>

                        </div>
                        <div class="row">
                          <div class="col-md-3"></div>
                          <div class="col-md-2"><h4>Categoria: </h4></div>
                          <div class="col-md-1"></div>
                          <div class="col-md-4">
                            <br>
                            <select name="categoria" class="form-control">
                              <option>Comidas</option>
                              <option>Bebidas</option>
                              <option>Ensaladas</option>
                            </select>
                          </div>
                          <div class="col-md-2"></div>

                        </div>
                        <br>
                        <div class="row">
                          <div class="col-md-3"></div>
                          <div class="col-md-1"><h4>Imagen: </h4></div>
                          <div class="col-md-1"></div>
                          <div class="col-md-3"><p><input type="file" accept="image/jpg" name="imagen"/></p></div>
                          <div class="col-md-3"></div>

                        </div>

                        <div class="row">
                          
                          <div class="col-md-12"><p><b>Todos los campos son obligatorios</b></p></div>

                        </div>

                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          <input type='hidden' name='action' value='create' />
                          <input type="submit" class="btn btn-primary"  value="Guardar">
                        </div>

                      </form>
                    </div> 
                  </div>

                  <!--Cierra Formulario-->

              </div>
              
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
     

        <div class="container">

          <h1>Añade una nueva receta!</h1>
        </div>


    </div>

    
    
     
    <!--aqui comienza el pie de pagina -->

    <div id="footer" class="container text-center">
      <nav class="navbar navbar-default navbar-fixed-bottom">
          <div class="navbar-inner navbar-content-center">
              <p class="text-muted credit miFooter">Create by <a href="">@Zeta</a> 2014</p>
          </div>
      </nav>
    </div>

 <?php }else{ ?>



    <div class="container">

      <form action="controller_sigin.php" method="get" class="form-signin" role="form">
        <h2 class="form-signin-heading">Please sign in</h2>
        <input type="email" name="email" id="email" class="form-control" placeholder="Email address" required autofocus>
        <input type="password" name="pass" id="pass" class="form-control" placeholder="Password" required>
        <label class="checkbox">
          <input type="checkbox" value="remember-me"> Remember me
        </label>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      </form>

    </div> <!-- /container -->


    <?php
       if(!empty($_GET['error']))
       {
        if($_GET['error'] == "1")
        {
          ?>

            <p class="bg-warning">Wrong User or password!. Please try again.</p>


          <?php
        }

        if($_GET['error'] == "2")
        {
          ?>

            <p class="bg-warning">Not descared!</p>


          <?php
        }      
      }
    ?>





 <?php } ?>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>



