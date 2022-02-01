<?php
  require_once("../conexion.php");
  $conection = @get_conection();
  if(!empty($_GET['id'])){
    $id = $_GET['id'];
    $result = @delete(
      $conection, "film", "film_id = $id"
    );
    header("Location:peliculas_show.php");
  }
 ?>
