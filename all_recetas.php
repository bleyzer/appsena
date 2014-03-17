<?php
session_start();

if(empty($_SESSION['id'])){
  header("location: view_sigin.php?error=2");
}



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

    <title>Recetas</title>

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

    <script type="text/javascript">

    function msj(){

      alert("Modificado correctamente");

    }

    function error(){
      alert("Error");
    }

    </script>


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
    <div class="container text-center top-buffer" style="width: 40%;">
      <div class="row">

       


        <div class="col-md-3">
          <form action="#" method="POST">
            <input type="submit" class="btn btn-info" value="Comidas">
          </form>  
        </div>
        <div class="col-md-3">
          <form action="#" method="POST">
            <input type="submit" class="btn btn-info" value="Bebidas">
          </form>  
        </div>
        <div class="col-md-3">
          <form action="#" method="POST">
            <input type="submit" class="btn btn-info" value="Ensaladas">
          </form>  
        </div>
        <div class="col-md-3">
          <form action="#" method="POST">
            <input type="hidden" name="action" value="todas"> 
            <input type="submit" class="btn btn-info" value="Todas">
          </form>  
        </div>

      </div>     

    </div>

    <div id="wrap"><!-- Wrap para espacio al final contra el footer -->

      <div class="container text-center" style="width: 50%;">

    <!--Codigo Php para mostrar recetas-->
    <?php  
        include 'libs/db_connect.php';

            $query = "select * from recetas";
            $stmt = $con->prepare( $query );
            $stmt->execute();


            while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
            {       
              extract($row);
              
              global $id;

              if($row==0){
                echo "No existen recetas para esta categoria";
              }else{
              //abre primer echo
               echo'
                <div class="container text-center" style="width: 100%;">
          
                <div class="row">
                  <div class="col-md-12"><h2>'.$nombre.'!</h2></div>
                </div>
                <div class="row">
                  <div class="col-md-6"><img src="img/default.jpg" class="img-responsive" alt="Image"></div>
                  <div class="col-md-6"><p>'.$ingredientes.'</p>
                  <a class="btn btn-success" data-toggle="modal" href="#modal-'.$id.'">Modificar</a>
                  <div class="modal fade" id="modal-'.$id.'">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                          <h4 class="modal-title">'.$nombre.'</h4>
                        </div>
                        <div class="modal-body">';//cierra segundo echo

              //codigo php para update
                
                

               
                

              //finalización de codigo php


              
              //abre echo para formulario 

              echo '<div class="form-group"> 

                    <div class="row">   
                      <form action="#" method="POST">

                        <h2>Modificalo!</h2><br>
                        <div class="row">
                          <div class="col-md-3"></div>
                          <div class="col-md-2"><h4>Nombre: </h4></div>
                          <div class="col-md-1"></div>
                          <div class="col-md-3"><input type="text" name="nombre" value="'.$nombre.'"></div>
                          <div class="col-md-3"></div>
                        </div>
                                <br>
                        <div class="row">
                          <div class="col-md-3"></div>
                          <div class="col-md-2"><h4>Ingredientes: </h4></div>
                          <div class="col-md-1"></div>
                          <div class="col-md-4"><textarea class="form-control" name="ingredientes" rows="5">'.$ingredientes.'</textarea></div>
                          <div class="col-md-2"></div>
                        </div>
                                <br>
                        <div class="row">
                          <div class="col-md-3"></div>
                          <div class="col-md-2"><h4>Preparación: </h4></div>
                          <div class="col-md-1"></div>
                          <div class="col-md-4"><textarea class="form-control" name="preparacion" rows="5">'.$preparacion.'</textarea></div>
                          <div class="col-md-2"></div>

                        </div>

                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          <input type="hidden" name="action" value="update" />
                          <input type="submit" class="btn btn-primary"  value="Guardar">
                        </div>

                      </form>
                    </div> 
                  </div>



              </div>
              ';//cierra echo formulario, esta ultima div cierra el cuerpo del modal



                   //abre segundo echo       
              echo ' </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                  </div><!-- /.modal -->
                  <button type="button" class="btn btn-danger">Eliminar</button>
                </div>
                </div>
                <hr>
              </div>

               '; //cierra segundo echo
             }
    ?>
    <!-- Final codigo php-->


      </div>


   </div>  <!--Cierra Wrap-->

    
    
     
    <!--aqui comienza el pie de pagina -->

    <div id="footer" class="container text-center">
      <nav class="navbar navbar-default navbar-fixed-bottom">
          <div class="navbar-inner navbar-content-center">
              <p class="text-muted credit miFooter">(c) Derechos reservados 2014.</p>
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