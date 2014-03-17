<?php
//include database connection
include 'libs/db_connect.php';

$action = isset($_GET['action']) ? $_GET['action'] : "";
$valorId = isset($_GET['idReceta']) ? $_GET['idReceta'] : ""; 

echo $valorId;
if($action=='deleted'){
    try {
      
      // delete query
      $query = "DELETE FROM recetas WHERE id = ?";
      $stmt = $con->prepare($query);
      $stmt->bindParam(1, $valorId);
      
      if($result = $stmt->execute()){
        // redirect to index page
        echo '
        <script lenguaje="javascript">alert("Has eliminado")</script>
      '; 
      }else{
        die('Unable to delete record.');
      }


      //header("location: recetasAdmin.php");
    }// to handle error
    catch(PDOException $exception){
      echo "Error: " . $exception->getMessage();
    }
   
   header("location: recetasAdmin.php");
  }

?>

