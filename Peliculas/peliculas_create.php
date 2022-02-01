<?php
require_once("../conexion.php");
$conection = @get_conection();
if ($conection['success']) {
  $idiomas = @select_from(
    $conection, "language",
    $columns = array('language_id', 'name'),
    $condition = "language_id > 0 ORDER BY name"
  );

  if(isset($_POST['submit']) && !empty($_POST['titulo']) &&
    !empty($_POST['idioma']) && !empty($_POST['duracion_renta']) &&
    !empty($_POST['precio_renta'] && !empty($_POST['costo_remplazo']))
  ){
    $pelicula = array(
      'title' => $_POST['titulo'],
      'description' => $_POST['descripcion'],
      'release_year' => (int)$_POST['anyo'],
      'language_id' => $_POST['idioma'],
      'rental_duration' => (int)$_POST['duracion_renta'],
      'rental_rate' => (float)$_POST['precio_renta'],
      'replacement_cost' => (float)$_POST['costo_remplazo'],
      'rating' => $_POST['clasificacion']
    );

    $response = @insert(
      $conection, "film", $pelicula
    );
    if($response['success']){
      header('Location:peliculas_show.php');
    }else {
      echo '<div class="alert alert-danger" role="alert">';
      echo $response['message'];
      echo '</div>';
    }
  }
}
 ?>

<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Agregar nueva película</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
  </head>
  <body>
    <div class="container" style="max-width: 500px">
      <div class="">
        <h3 class="text-align-center">Agregar nueva película</h2>
      </div>
      <?php include("peliculas_formulario.php") ?>
    </div>
    <script src="../js/bootstrap.min.js"></script>
  </body>
</html>
