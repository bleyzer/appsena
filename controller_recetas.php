<?php
$action = isset($_POST['action']) ? $_POST['action'] : "";

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
                <div class="container text-center">          
                  
                    <p>'.$nombre.'<a href="recetasAdmin.php?modal=1&tipo='.$id.'">Editar</a></p>
                    
                </div> '  ;//cierra segundo echo


                  }    
          }
} 

?>