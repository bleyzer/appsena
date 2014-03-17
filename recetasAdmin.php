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

    <title>Recetas admin</title>

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
    
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap-modal.js"></script>
    <script src="js/bootstrap.min.js"></script>

  </head>

  <body>

<!--Comienzo del modal -->
       
       <div class="modal fade" id="example">
         <div class="modal-dialog">
           <div class="modal-content">
             <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
               <h4 class="modal-title">Modificalo</h4>
             </div>
             <div class="modal-body">
            <?php if(!empty($_GET['tipo'])){
                  
                  include("prueba1.php");

                  }
            ?>
             </div>
             
           </div><!-- /.modal-content -->
         </div><!-- /.modal-dialog -->
       </div><!-- /.modal -->
    <!--Final del modal -->


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
        <div class="col-md-12">
          <form action="#" method="POST">
            <input type="hidden" name="action" value="todas"> 
            <input type="submit" class="btn btn-info" value="Todas">
          </form>  
        </div>

      </div>     

    </div>




    <div id="wrap"><!-- Wrap para espacio al final contra el footer -->

      <div class="container text-center">

         <script languaje="text/javascript">
          function eliminado(id){
            var idReceta= "formEliminar"+id;
              var respuesta = confirm("¿Deseas eliminar esta receta?");
             if (respuesta==true){ 
               document.getElementById(idReceta).submit();  
             }
            }
          </script>

         
          <?php 


           $action = isset($_POST['action']) ? $_POST['action'] : "";
           $valorId = isset($_POST['idReceta']) ? $_POST['idReceta'] : "";

          if($action=='todas'){


            include 'libs/db_connect.php';

            $query = "select * from recetas";
            $stmt = $con->prepare( $query );
            $stmt->execute();


            while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
            {       
              extract($row);

              if($row==0){
                echo "No existen recetas para esta categoria";
              }else{
              //abre primer echo
               echo'
                <div class="container text-center" style="width: 50%;">          
                <div class="row">
                  <div class="col-md-12"><h2>'.$nombre.'!</h2></div>
                </div>
                <div class="row">
                  <div class="col-md-6"><img src="imagenes/'.$imagen.'" class="img-responsive" alt="Image"></div>
                  <div class="col-md-6"><p><b>Ingredientes: </b>'.$ingredientes.'</p><br>
                  <p><b>Preparacion: </b>'.$preparacion.'</p><br>
                  <p><b>Categoria: </b>'.$Categoria.'</p><br>
                  <p><a class="btn btn-success" href="recetasAdmin.php?modal=1&tipo='.$id.'">Modificar</a></p>
                  <form name="formEliminar" action="delete.php" id="formEliminar'.$id.'" method="GET">
                  <input type="hidden" name="idReceta" value="'.$id.'">
                  <input type="hidden" name="action" value="deleted">
                  <input type="button" class="btn btn-danger" onclick="eliminado('.$id.')" value="Eliminar">
                  </form>                    
                </div> 
                </div>
                </div>
                ' ;//cierra segundo echo

                  }    
            }
          } 

          //inicio de if para actualizar
        if($action == "update"){
          
                  try{
                  
                    /*echo "Entre al if update";
                    echo $valorId.$valorIngredientes.$valorPreparacion ;*/
                    //write query
                    //in this case, it seemed like we have so many fields to pass and 
                    //its kinda better if we'll label them and not use question marks
                    //like what we used here
                    $query = "UPDATE recetas 
                          set nombre = :nombre, ingredientes = :ingredientes, preparacion = :preparacion, categoria = :categoria, imagen = :imagen
                          where id = :id";

                    //prepare query for excecution
                    $stmt = $con->prepare($query);

                    //bind the parameters
                    $stmt->bindParam(':nombre', $_POST['nombre']);
                    $stmt->bindParam(':ingredientes', $_POST['ingredientes']);
                    $stmt->bindParam(':preparacion', $_POST['preparacion']);
                    $stmt->bindParam(':categoria', $_POST['categoria']);
                    $stmt->bindParam(':imagen', $_FILES['imagen']['name']);
                    $stmt->bindParam(':id', $valorId);
                    
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

                      <script type="text/javascript">

                     alert("Modificado correctamente");

                      </script>

                      ';
                    }else{
                      echo'<script type="text/javascript">

                      alert("No he eliminado");

                      </script>';
                      die('Unable to update record.');
                    }
                    
                  }catch(PDOException $exception){ //to handle error
                    echo "Error: " . $exception->getMessage();
                  }
                }


        ?>

    <!-- Final codigo php-->

      </div>


   </div>  <!--Cierra Wrap-->

    
    
     
    <!--aqui comienza el pie de pagina -->

    <div id="footer" class="container text-center">
      <nav class="navbar navbar-default navbar-fixed-bottom">
          <div class="navbar-inner navbar-content-center">
              <p class="text-muted credit miFooter">Create by <a href="">@Zeta</a> 2014</p>
          </div>
      </nav>
    </div>

    <?php
      if(!isset($_GET["modal"]))
        $_GET["modal"] = 0;


      if($_GET["modal"] == 1)
      {
        
      ?>

         <script type="text/javascript">
         $('#example').modal('show');
         </script>
    <?php
      }
    ?>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->

      
    
  </body>
</html>