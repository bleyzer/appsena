<?php


$id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $ingredientes = $_POST['ingredientes'];
        $preparacion = $_POST['preparacion'];
        $imagen = $_POST['imagen'];
        $categoria = $_POST['categoria'];

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

    <title><?php echo $nombre; ?></title>

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

   

   <div class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand" href="index.html">Supera el cancer</a>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="view_sigin.php">Home</a></li>
            <li><a href="recetasAdmin.php">Recetas</a></li>
            <li><a href="acercade.html">Nosotros</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>
    <br>


    <div id="wrap"><!-- Wrap para espacio al final contra el footer -->

      

           <!--Codigo Php para mostrar recetas-->

        <?php

        

       echo ' <div class="container text-center" style="width: 50%;">
                
                <div class="row">
                  <div class="col-md-12"><h1>'.$nombre.'</h1></div>
                </div>
                <div class="row">
                  <div class="col-md-6"><img src="img/'.$imagen.'" class="img-responsive" alt="Image"></div>
                  <div class="col-md-6"><p><b>Categoria: </b>'.$categoria.'</p>
                  <p><b>Ingredientes: </b>'.$ingredientes.'</p>
                  <p><b>Preparación: </b>'.$preparacion.'</p></div>
                </div>




              </div>';
        ?>

    <!-- Final codigo php-->


      

      


   </div>  <!--Cierra Wrap-->

    
    
     
    <!--aqui comienza el pie de pagina -->

    <div id="footer" class="container text-center">
      <nav class="navbar navbar-default navbar-fixed-bottom">
          <div class="navbar-inner navbar-content-center">
              <p class="text-muted credit miFooter">Create by <a href="">@Zeta</a> 2014</p>
          </div>
      </nav>
    </div>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>