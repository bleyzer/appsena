<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Juan Sebastian Duque">
    <link rel="shortcut icon">

    <title>Recetas-Supera el Cancer</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/starter-template.css" rel="stylesheet">
    <link href="css/form.css" rel="stylesheet">
    <link href="css/recetas.css" rel="stylesheet">

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
            <li><a href="index.html">Home</a></li>
            <li class="active"><a href="#Recetas">Recetas</a></li>
            <li><a href="acercade.html">Nosotros</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

    <!-- Menú de comidas/bebidas debajo de la barra de navegación -->
    <div class="container text-center top-buffer" style="width: 40%;">
      <div class="row">

       


        <div class="col-md-3">
          <form action="#" method="POST">
            <input type="hidden" name="action" value="comidas"> 
            <input type="submit" class="btn btn-info" value="Comidas">
          </form>  
        </div>
        <div class="col-md-3">
          <form action="#" method="POST">
            <input type="hidden" name="action" value="bebidas"> 
            <input type="submit" class="btn btn-info" value="Bebidas">
          </form>  
        </div>
        <div class="col-md-3">
          <form action="#" method="POST">
            <input type="hidden" name="action" value="ensaladas"> 
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
        $action = isset($_POST['action']) ? $_POST['action'] : ""; 

        //comienzo del if()
        if($action=='todas'){

            include 'libs/db_connect.php';

            $query = "select * from recetas";
            $stmt = $con->prepare( $query );
            $stmt->execute();

            echo '<div class="container" style="width: 100%;">
            <br>
            <div class="row">


            <div class="col-md-4">
            <p><b>Ordenado por:</b></p>     
            </div>

            <div class="col-md-4"><form action="#" method="POST">
                <input type="hidden" name="action" value="orderByASC"> 
                <input type="submit" class="btn btn-info" value="Nombre">
            </form></div>
            <div class="col-md-4">
            <form action="#" method="POST">
                <input type="hidden" name="action" value="orderByDESC"> 
                <input type="submit" class="btn btn-info" value="Nombre DESC">
            </form></div>


           


            </div>';
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
            {       
              extract($row);

              if($row==0){
                echo "No existen recetas para esta categoria";
              }

               echo'
                <div class="container text-center" style="width: 100%;">
          
                <div class="row">
                  <div class="col-md-12"><h2>'.$nombre.'!</h2></div>
                </div>
                <div class="row">
                  <div class="col-md-6"><img src="imagenes/'.$imagen.'" class="img-responsive" alt="Image"></div>
                  <div class="col-md-6"><p><b>Categoria: </b>'.$Categoria.'</p><br>
                  <form action="single_receta.php" method="POST">
                    <input type="hidden" name="id" value="'.$id.'" />
                    <input type="hidden" name="categoria" value="'.$Categoria.'"/>
                    <input type="hidden" name="nombre" value="'.$nombre.'"/>
                    <input type="hidden" name="ingredientes" value="'.$ingredientes.'"/>
                    <input type="hidden" name="preparacion" value="'.$preparacion.'"/>
                    <input type="hidden" name="imagen" value="'.$imagen.'"/>
                    <input type="submit" class="btn btn-info"  value="ver más..."/>
                  </form>

                </div>
                </div>
                <hr>
              </div>

               ';
             }

        } //finaliza del if(==todas) 

        if($action=='orderByASC'){

            include 'libs/db_connect.php';

            $query = 'select * from recetas ORDER BY nombre';
            $stmt = $con->prepare( $query );
            $stmt->execute();

            echo '<div class="container text-center" style="width: 100%;">
            <br>
            <div class="row">


            <div class="col-md-4">
            <p><b>Ordenado por:</b></p>  
            </div>
            <div class="col-md-4"><form action="#" method="POST">
                <input type="hidden" name="action" value="orderByASC"> 
                <input type="submit" class="btn btn-info" value="Nombre">
              </form></div>

            <div class="col-md-4"><form action="#" method="POST">
                <input type="hidden" name="action" value="orderByDESC"> 
                <input type="submit" class="btn btn-info" value="Nombre DESC">
              </form></div>


           


            </div>';
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
            {       
              extract($row);

              if($row==0){
                echo "No existen recetas para esta categoria";
              }

               echo'
                <div class="container text-center" style="width: 100%;">
          
                <div class="row">
                  <div class="col-md-12"><h2>'.$nombre.'!</h2></div>
                </div>
                <div class="row">
                  <div class="col-md-6"><img src="imagenes/'.$imagen.'" class="img-responsive" alt="Image"></div>
                  <div class="col-md-6"><p><b>Categoria: </b>'.$Categoria.'</p><br>
                  <form action="single_receta.php" method="POST">
                    <input type="hidden" name="id" value="'.$id.'" />
                    <input type="hidden" name="categoria" value="'.$Categoria.'"/>
                    <input type="hidden" name="nombre" value="'.$nombre.'"/>
                    <input type="hidden" name="ingredientes" value="'.$ingredientes.'"/>
                    <input type="hidden" name="preparacion" value="'.$preparacion.'"/>
                    <input type="hidden" name="imagen" value="'.$imagen.'"/>
                    <input type="submit" class="btn btn-info"  value="ver más..."/>
                  </form>

                </div>
                </div>
                <hr>
              </div>

               ';
             }

        } //finaliza del if(==todas) 

        if($action=='orderByDESC'){

            include 'libs/db_connect.php';

            $query = 'select * from recetas ORDER BY nombre DESC';
            $stmt = $con->prepare( $query );
            $stmt->execute();

            echo '<div class="container text-center" style="width: 100%;">
            <br>
            <div class="row">


            <div class="col-md-4">
            <p><b>Ordenado por:</b></p>  
            </div>
            <div class="col-md-4"><form action="#" method="POST">
                <input type="hidden" name="action" value="orderByASC"> 
                <input type="submit" class="btn btn-info" value="Nombre">
              </form></div>

            <div class="col-md-4"><form action="#" method="POST">
                <input type="hidden" name="action" value="orderByDESC"> 
                <input type="submit" class="btn btn-info" value="Nombre DESC">
              </form></div>



           


            </div>';
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
            {       
              extract($row);

              if($row==0){
                echo "No existen recetas para esta categoria";
              }

               echo'
                <div class="container text-center" style="width: 100%;">
          
                <div class="row">
                  <div class="col-md-12"><h2>'.$nombre.'!</h2></div>
                </div>
                <div class="row">
                  <div class="col-md-6"><img src="imagenes/'.$imagen.'" class="img-responsive" alt="Image"></div>
                  <div class="col-md-6"><p><b>Categoria: </b>'.$Categoria.'</p><br>
                  <form action="single_receta.php" method="POST">
                    <input type="hidden" name="id" value="'.$id.'" />
                    <input type="hidden" name="categoria" value="'.$Categoria.'"/>
                    <input type="hidden" name="nombre" value="'.$nombre.'"/>
                    <input type="hidden" name="ingredientes" value="'.$ingredientes.'"/>
                    <input type="hidden" name="preparacion" value="'.$preparacion.'"/>
                    <input type="hidden" name="imagen" value="'.$imagen.'"/>
                    <input type="submit" class="btn btn-info"  value="ver más..."/>
                  </form>

                </div>
                </div>
                <hr>
              </div>

               ';
             }

        }

        //comienza codigo para comidas y order by

        if($action=='comidas'){

            include 'libs/db_connect.php';

            $query = 'select * from recetas where Categoria = "Comidas"';
            $stmt = $con->prepare( $query );
            $stmt->execute();

            echo '<div class="container text-center" style="width: 100%;">
            <br>
            <div class="row">


            <div class="col-md-4">
            <p><b>Ordenado por:</b></p>
            </div>

            <div class="col-md-4">
              <form action="#" method="POST">
                <input type="hidden" name="action" value="orderByASCComidas"> 
                <input type="submit" class="btn btn-info" value="Nombre">
              </form>
            </div>
            <div class="col-md-4">
                <form action="#" method="POST">
                <input type="hidden" name="action" value="orderByDESCComidas"> 
                <input type="submit" class="btn btn-info" value="Nombre DESC">
                </form>
            </div>


           


            </div>';
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
            {       
              extract($row);

              if($row==0){
                echo "No existen recetas para esta categoria";
              }

               echo'
                <div class="container text-center" style="width: 100%;">
          
                <div class="row">
                  <div class="col-md-12"><h2>'.$nombre.'!</h2></div>
                </div>
                <div class="row">
                  <div class="col-md-6"><img src="imagenes/'.$imagen.'" class="img-responsive" alt="Image"></div>
                  <div class="col-md-6"><p><b>Categoria: </b>'.$Categoria.'</p><br>
                  <form action="single_receta.php" method="POST">
                    <input type="hidden" name="id" value="'.$id.'" />
                    <input type="hidden" name="categoria" value="'.$Categoria.'"/>
                    <input type="hidden" name="nombre" value="'.$nombre.'"/>
                    <input type="hidden" name="ingredientes" value="'.$ingredientes.'"/>
                    <input type="hidden" name="preparacion" value="'.$preparacion.'"/>
                    <input type="hidden" name="imagen" value="'.$imagen.'"/>
                    <input type="submit" class="btn btn-info"  value="ver más..."/>
                  </form>

                </div>
                </div>
                <hr>
              </div>

               ';
             }

        } //finaliza del if(==todas) 


        if($action=='orderByASCComidas'){

            include 'libs/db_connect.php';

            $query = 'select * from recetas where Categoria = "Comidas" ORDER BY nombre';
            $stmt = $con->prepare( $query );
            $stmt->execute();

            echo '<div class="container text-center" style="width: 100%;">
            <br>
            <div class="row">


            <div class="col-md-4">
            <p><b>Ordenado por:</b></p>
            </div>

            <div class="col-md-4">
              <form action="#" method="POST">
                <input type="hidden" name="action" value="orderByASCComidas"> 
                <input type="submit" class="btn btn-info" value="Nombre">
              </form>
            </div>
            <div class="col-md-4">
                <form action="#" method="POST">
                <input type="hidden" name="action" value="orderByDESCComidas"> 
                <input type="submit" class="btn btn-info" value="Nombre DESC">
                </form>
            </div>


           


            </div>';
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
            {       
              extract($row);

              if($row==0){
                echo "No existen recetas para esta categoria";
              }

               echo'
                <div class="container text-center" style="width: 100%;">
          
                <div class="row">
                  <div class="col-md-12"><h2>'.$nombre.'!</h2></div>
                </div>
                <div class="row">
                  <div class="col-md-6"><img src="imagenes/'.$imagen.'" class="img-responsive" alt="Image"></div>
                  <div class="col-md-6"><p><b>Categoria: </b>'.$Categoria.'</p><br>
                  <form action="single_receta.php" method="POST">
                    <input type="hidden" name="id" value="'.$id.'" />
                    <input type="hidden" name="categoria" value="'.$Categoria.'"/>
                    <input type="hidden" name="nombre" value="'.$nombre.'"/>
                    <input type="hidden" name="ingredientes" value="'.$ingredientes.'"/>
                    <input type="hidden" name="preparacion" value="'.$preparacion.'"/>
                    <input type="hidden" name="imagen" value="'.$imagen.'"/>
                    <input type="submit" class="btn btn-info"  value="ver más..."/>
                  </form>

                </div>
                </div>
                <hr>
              </div>

               ';
             }

        } //finaliza del if(==todas) 

        if($action=='orderByDESCComidas'){

            include 'libs/db_connect.php';

            $query = 'select * from recetas where Categoria = "Comidas" ORDER BY nombre DESC';
            $stmt = $con->prepare( $query );
            $stmt->execute();

            echo '<div class="container text-center" style="width: 100%;">
            <br>
            <div class="row">


            <div class="col-md-4">
            <p><b>Ordenado por:</b></p>
            </div>

            <div class="col-md-4">
              <form action="#" method="POST">
                <input type="hidden" name="action" value="orderByASCComidas"> 
                <input type="submit" class="btn btn-info" value="Nombre">
              </form>
            </div>
            <div class="col-md-4">
                <form action="#" method="POST">
                <input type="hidden" name="action" value="orderByDESCComidas"> 
                <input type="submit" class="btn btn-info" value="Nombre DESC">
                </form>
            </div>


           


            </div>';
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
            {       
              extract($row);

              if($row==0){
                echo "No existen recetas para esta categoria";
              }

               echo'
                <div class="container text-center" style="width: 100%;">
          
                <div class="row">
                  <div class="col-md-12"><h2>'.$nombre.'!</h2></div>
                </div>
                <div class="row">
                  <div class="col-md-6"><img src="imagenes/'.$imagen.'" class="img-responsive" alt="Image"></div>
                  <div class="col-md-6"><p><b>Categoria: </b>'.$Categoria.'</p><br>
                  <form action="single_receta.php" method="POST">
                    <input type="hidden" name="id" value="'.$id.'" />
                    <input type="hidden" name="categoria" value="'.$Categoria.'"/>
                    <input type="hidden" name="nombre" value="'.$nombre.'"/>
                    <input type="hidden" name="ingredientes" value="'.$ingredientes.'"/>
                    <input type="hidden" name="preparacion" value="'.$preparacion.'"/>
                    <input type="hidden" name="imagen" value="'.$imagen.'"/>
                    <input type="submit" class="btn btn-info"  value="ver más..."/>
                  </form>

                </div>
                </div>
                <hr>
              </div>

               ';
             }

        } //finaliza codigo para Comidas, Order by

        //comienza codigo para bebidas y order by

        if($action=='bebidas'){

            include 'libs/db_connect.php';

            $query = 'select * from recetas where Categoria = "Bebidas"';
            $stmt = $con->prepare( $query );
            $stmt->execute();

            echo '<div class="container text-center" style="width: 100%;">
            <br>
            <div class="row">


            <div class="col-md-4">
            <p><b>Ordenado por:</b></p>     
            </div>

            <div class="col-md-4">
              <form action="#" method="POST">
                <input type="hidden" name="action" value="orderByASCBebidas"> 
                <input type="submit" class="btn btn-info" value="Nombre">
              </form>
            </div>


            <div class="col-md-4">
              <form action="#" method="POST">
                <input type="hidden" name="action" value="orderByDESCBebidas"> 
                <input type="submit" class="btn btn-info" value="Nombre DESC">
              </form>
            </div>


           


            </div>';
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
            {       
              extract($row);

              if($row==0){
                echo "No existen recetas para esta categoria";
              }

               echo'
                <div class="container text-center" style="width: 100%;">
          
                <div class="row">
                  <div class="col-md-12"><h2>'.$nombre.'!</h2></div>
                </div>
                <div class="row">
                  <div class="col-md-6"><img src="imagenes/'.$imagen.'" class="img-responsive" alt="Image"></div>
                  <div class="col-md-6"><p><b>Categoria: </b>'.$Categoria.'</p><br>
                  <form action="single_receta.php" method="POST">
                    <input type="hidden" name="id" value="'.$id.'" />
                    <input type="hidden" name="categoria" value="'.$Categoria.'"/>
                    <input type="hidden" name="nombre" value="'.$nombre.'"/>
                    <input type="hidden" name="ingredientes" value="'.$ingredientes.'"/>
                    <input type="hidden" name="preparacion" value="'.$preparacion.'"/>
                    <input type="hidden" name="imagen" value="'.$imagen.'"/>
                    <input type="submit" class="btn btn-info"  value="ver más..."/>
                  </form>

                </div>
                </div>
                <hr>
              </div>

               ';
             }

        } //finaliza del if(==todas) 


        if($action=='orderByASCBebidas'){

            include 'libs/db_connect.php';

            $query = 'select * from recetas where Categoria = "Bebidas" ORDER BY nombre';
            $stmt = $con->prepare( $query );
            $stmt->execute();

            echo '<div class="container text-center" style="width: 100%;">
            <br>
            <div class="row">


            <div class="col-md-4">
            <p><b>Ordenado por:</b></p>     
            </div>

            <div class="col-md-4">
              <form action="#" method="POST">
                <input type="hidden" name="action" value="orderByASCBebidas"> 
                <input type="submit" class="btn btn-info" value="Nombre">
              </form>
            </div>


            <div class="col-md-4">
              <form action="#" method="POST">
                <input type="hidden" name="action" value="orderByDESCBebidas"> 
                <input type="submit" class="btn btn-info" value="Nombre DESC">
              </form>
            </div>


           


            </div>';
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
            {       
              extract($row);

              if($row==0){
                echo "No existen recetas para esta categoria";
              }

               echo'
                <div class="container text-center" style="width: 100%;">
          
                <div class="row">
                  <div class="col-md-12"><h2>'.$nombre.'!</h2></div>
                </div>
                <div class="row">
                  <div class="col-md-6"><img src="imagenes/'.$imagen.'" class="img-responsive" alt="Image"></div>
                  <div class="col-md-6"><p><b>Categoria: </b>'.$Categoria.'</p><br>
                  <form action="single_receta.php" method="POST">
                    <input type="hidden" name="id" value="'.$id.'" />
                    <input type="hidden" name="categoria" value="'.$Categoria.'"/>
                    <input type="hidden" name="nombre" value="'.$nombre.'"/>
                    <input type="hidden" name="ingredientes" value="'.$ingredientes.'"/>
                    <input type="hidden" name="preparacion" value="'.$preparacion.'"/>
                    <input type="hidden" name="imagen" value="'.$imagen.'"/>
                    <input type="submit" class="btn btn-info"  value="ver más..."/>
                  </form>

                </div>
                </div>
                <hr>
              </div>

               ';
             }

        } //finaliza del if(==todas) 

        if($action=='orderByDESCBebidas'){

            include 'libs/db_connect.php';

            $query = 'select * from recetas where Categoria = "Bebidas" ORDER BY nombre DESC';
            $stmt = $con->prepare( $query );
            $stmt->execute();

            echo '<div class="container text-center" style="width: 100%;">
            <br>
            <div class="row">


            <div class="col-md-4">
            <p><b>Ordenado por:</b></p>     
            </div>

            <div class="col-md-4">
              <form action="#" method="POST">
                <input type="hidden" name="action" value="orderByASCBebidas"> 
                <input type="submit" class="btn btn-info" value="Nombre">
              </form>
            </div>


            <div class="col-md-4">
              <form action="#" method="POST">
                <input type="hidden" name="action" value="orderByDESCBebidas"> 
                <input type="submit" class="btn btn-info" value="Nombre DESC">
              </form>
            </div>


           


            </div>';
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
            {       
              extract($row);

              if($row==0){
                echo "No existen recetas para esta categoria";
              }

               echo'
                <div class="container text-center" style="width: 100%;">
          
                <div class="row">
                  <div class="col-md-12"><h2>'.$nombre.'!</h2></div>
                </div>
                <div class="row">
                  <div class="col-md-6"><img src="imagenes/'.$imagen.'" class="img-responsive" alt="Image"></div>
                  <div class="col-md-6"><p><b>Categoria: </b>'.$Categoria.'</p><br>
                  <form action="single_receta.php" method="POST">
                    <input type="hidden" name="id" value="'.$id.'" />
                    <input type="hidden" name="categoria" value="'.$Categoria.'"/>
                    <input type="hidden" name="nombre" value="'.$nombre.'"/>
                    <input type="hidden" name="ingredientes" value="'.$ingredientes.'"/>
                    <input type="hidden" name="preparacion" value="'.$preparacion.'"/>
                    <input type="hidden" name="imagen" value="'.$imagen.'"/>
                    <input type="submit" class="btn btn-info"  value="ver más..."/>
                  </form>

                </div>
                </div>
                <hr>
              </div>

               ';
             }

        } //finaliza codigo para Bebidas, Order by

        //comienza codigo para bebidas y order by

        if($action=='ensaladas'){

            include 'libs/db_connect.php';

            $query = 'select * from recetas where Categoria = "Ensaladas"';
            $stmt = $con->prepare( $query );
            $stmt->execute();

            echo '<div class="container text-center" style="width: 100%;">
            <br>
            <div class="row">


            <div class="col-md-4">
              <p><b>Ordenado por:</b></p>
            </div>

            <div class="col-md-4">
              <form action="#" method="POST">
                <input type="hidden" name="action" value="orderByASCEnsaladas"> 
                <input type="submit" class="btn btn-info" value="Nombre">
              </form>
            </div>
            <div class="col-md-4">
              <form action="#" method="POST">
                <input type="hidden" name="action" value="orderByDESCEnsaladas"> 
                <input type="submit" class="btn btn-info" value="Nombre DESC">
              </form>
            </div>


           


            </div>';
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
            {       
              extract($row);

              if($row==0){
                echo "No existen recetas para esta categoria";
              }

               echo'
                <div class="container text-center" style="width: 100%;">
          
                <div class="row">
                  <div class="col-md-12"><h2>'.$nombre.'!</h2></div>
                </div>
                <div class="row">
                  <div class="col-md-6"><img src="imagenes/'.$imagen.'" class="img-responsive" alt="Image"></div>
                  <div class="col-md-6"><p><b>Categoria: </b>'.$Categoria.'</p><br>
                  <form action="single_receta.php" method="POST">
                    <input type="hidden" name="id" value="'.$id.'" />
                    <input type="hidden" name="categoria" value="'.$Categoria.'"/>
                    <input type="hidden" name="nombre" value="'.$nombre.'"/>
                    <input type="hidden" name="ingredientes" value="'.$ingredientes.'"/>
                    <input type="hidden" name="preparacion" value="'.$preparacion.'"/>
                    <input type="hidden" name="imagen" value="'.$imagen.'"/>
                    <input type="submit" class="btn btn-info"  value="ver más..."/>
                  </form>

                </div>
                </div>
                <hr>
              </div>

               ';
             }

        } //finaliza del if(==todas) 


        if($action=='orderByASCEnsaladas'){

            include 'libs/db_connect.php';

            $query = 'select * from recetas where Categoria = "Ensaladas" ORDER BY nombre';
            $stmt = $con->prepare( $query );
            $stmt->execute();

            echo '<div class="container text-center" style="width: 100%;">
            <br>
            <div class="row">


            <div class="col-md-4">
              <p><b>Ordenado por:</b></p>
            </div>

            <div class="col-md-4">
              <form action="#" method="POST">
                <input type="hidden" name="action" value="orderByASCEnsaladas"> 
                <input type="submit" class="btn btn-info" value="Nombre">
              </form>
            </div>
            <div class="col-md-4">
              <form action="#" method="POST">
                <input type="hidden" name="action" value="orderByDESCEnsaladas"> 
                <input type="submit" class="btn btn-info" value="Nombre DESC">
              </form>
            </div>

           


            </div>';
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
            {       
              extract($row);

              if($row==0){
                echo "No existen recetas para esta categoria";
              }

               echo'
                <div class="container text-center" style="width: 100%;">
          
                <div class="row">
                  <div class="col-md-12"><h2>'.$nombre.'!</h2></div>
                </div>
                <div class="row">
                  <div class="col-md-6"><img src="imagenes/'.$imagen.'" class="img-responsive" alt="Image"></div>
                  <div class="col-md-6"><p><b>Categoria: </b>'.$Categoria.'</p><br>
                  <form action="single_receta.php" method="POST">
                    <input type="hidden" name="id" value="'.$id.'" />
                    <input type="hidden" name="categoria" value="'.$Categoria.'"/>
                    <input type="hidden" name="nombre" value="'.$nombre.'"/>
                    <input type="hidden" name="ingredientes" value="'.$ingredientes.'"/>
                    <input type="hidden" name="preparacion" value="'.$preparacion.'"/>
                    <input type="hidden" name="imagen" value="'.$imagen.'"/>
                    <input type="submit" class="btn btn-info"  value="ver más..."/>
                  </form>

                </div>
                </div>
                <hr>
              </div>

               ';
             }

        } //finaliza del if(==todas) 

        if($action=='orderByDESCEnsaladas'){

            include 'libs/db_connect.php';

            $query = 'select * from recetas where Categoria = "Ensaladas" ORDER BY nombre DESC';
            $stmt = $con->prepare( $query );
            $stmt->execute();

            echo '<div class="container text-center" style="width: 100%;">
            <br>
            <div class="row">


            <div class="col-md-4">
              <p><b>Ordenado por:</b></p>
            </div>

            <div class="col-md-4">
              <form action="#" method="POST">
                <input type="hidden" name="action" value="orderByASCEnsaladas"> 
                <input type="submit" class="btn btn-info" value="Nombre">
              </form>
            </div>
            <div class="col-md-4">
              <form action="#" method="POST">
                <input type="hidden" name="action" value="orderByDESCEnsaladas"> 
                <input type="submit" class="btn btn-info" value="Nombre DESC">
              </form>
            </div>


           


            </div>';
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
            {       
              extract($row);

              if($row==0){
                echo "No existen recetas para esta categoria";
              }

               echo'
                <div class="container text-center" style="width: 100%;">
          
                <div class="row">
                  <div class="col-md-12"><h2>'.$nombre.'!</h2></div>
                </div>
                <div class="row">
                  <div class="col-md-6"><img src="imagenes/'.$imagen.'" class="img-responsive" alt="Image"></div>
                  <div class="col-md-6"><p><b>Categoria: </b>'.$Categoria.'</p><br>
                  <form action="single_receta.php" method="POST">
                    <input type="hidden" name="id" value="'.$id.'" />
                    <input type="hidden" name="categoria" value="'.$Categoria.'"/>
                    <input type="hidden" name="nombre" value="'.$nombre.'"/>
                    <input type="hidden" name="ingredientes" value="'.$ingredientes.'"/>
                    <input type="hidden" name="preparacion" value="'.$preparacion.'"/>
                    <input type="hidden" name="imagen" value="'.$imagen.'"/>
                    <input type="submit" class="btn btn-info"  value="ver más..."/>
                  </form>
                </div>
                </div>
                <hr>
              </div>

               ';
             }

        } //finaliza codigo para Bebidas, Order by


        ?>

    <!-- Final codigo php-->


      </div>


   </div>  <!--Cierra Wrap-->


    <!--aqui comienza el pie de pagina -->

    <div id="footer" class="container text-center">
      <nav class="container">
          <div class="navbar-inner navbar-content-center">
              <p class="text-muted credit miFooter">Create by <a href="">@Zeta</a> 2014</p>
          </div>
      </nav>
    </div> <!--Finaliza el footer-->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>