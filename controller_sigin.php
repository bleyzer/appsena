<?php
session_start();



if(!empty($_GET['opcion']))
{
  if($_GET['opcion'] == "salir")
  {
    unset($_SESSION["id"]); 
    unset($_SESSION["email"]);
    unset($_SESSION["pass"]);
    session_destroy();
  }    
}

include 'libs/db_connect.php';

$query = "select id, email from administrador where email = ? AND pass= ? limit 0,1";
$stmt = $con->prepare( $query );
$stmt->bindParam(1, $_GET['email']);
$stmt->bindParam(2, $_GET['pass']);
$stmt->execute();

$num = $stmt->rowCount();
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if(empty($_GET['opcion']))
{  
  if($num > 0)
  {
      $_SESSION["email"] = $row['email'];
      $_SESSION["id"] = $row['id'];
  }
  else
  {  
    header('Location: view_sigin.php?error=1');
    exit();
  }
}

header('Location: view_sigin.php');

?>