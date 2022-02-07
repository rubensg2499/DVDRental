<?php
require_once("../conexion.php");
$conection = @get_conection();
if ($conection['success']) {
  //Al guardar
  if(isset($_POST['submit']) && !empty($_POST['nombre'])){
    $categoria = array(
      'name' => $_POST['nombre']
    );

    $response = @insert(
      $conection, "category", $categoria
    );
    if($response['success']){
      header('Location:categorias_show.php');
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
    <title>Agregar nueva categoría</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/master.css">
  </head>
  <body>
    <div class="container" style="max-width: 500px">
      <div class="">
        <h3 class="text-align-center">Agregar nueva categoría</h2>
      </div>
      <form method="POST" action="">
        <div class="form-group">
          <label for="nombre">Categoría<span style="color:red">*</span></label>
          <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Ej. Acción" required>
        </div>
        <br>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <input type="submit" class="form-control btn btn-outline-success" name="submit" value="Guardar">
            </div>
          </div>
          <div class="col-md-6">
            <a href="categorias_show.php" class="form-control btn btn-outline-danger">Cancelar</a>
          </div>
        </div>
        <br>
      </form>
    </div>
    <script src="../js/bootstrap.min.js"></script>
  </body>
</html>
