<?php
require_once("../conexion.php");
$conection = @get_conection();
if ($conection['success']) {
  $idiomas = @select_from(
    $conection, "language",
    $columns = array('language_id', 'name'),
    $condition = "language_id > 0 ORDER BY name"
  );
  $edit = false;
  //Al guardar
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
    <link rel="stylesheet" href="../css/master.css">
  </head>
  <body>
    <div class="container" style="max-width: 500px">
      <div class="">
        <h3 class="text-align-center">Agregar nueva película</h2>
      </div>
      <form method="POST" action="">
        <div class="form-group">
          <label for="titulo">Título<span style="color:red">*</span></label>
          <input type="text" class="form-control" name="titulo" id="titulo" placeholder="Ej. Las aventuras de Aladino" required>
        </div>
        <div class="form-group">
          <label for="descripcion">Descripción</label>
          <textarea class="form-control" name="descripcion" id="descripcion" placeholder="Ej. Una película de aventuras donde..."></textarea>
        </div>
        <div class="form-group">
          <label for="anyo">Año de estreno<span style="color:red">*</span></label>
          <input type="number" class="form-control" name="anyo" id="anyo" min="1901" max="2155" placeholder="Ej. 2015" required>
        </div>
        <div class="form-group">
            <label for="idioma">Idioma<span style="color:red">*</span></label>
            <select name="idioma" id="idioma" class="form-control" required>
              <?php foreach ($idiomas['result'] as $idioma): ?>
                <option value="<?php echo $idioma['language_id']; ?>"><?php echo $idioma['name']; ?></option>
              <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
          <label for="duracion_renta">Duración de renta<span style="color:red">*</span></label>
          <input type="number" class="form-control" name="duracion_renta" id="duracion_renta" placeholder="Ej. 5" required>
        </div>
        <div class="form-group">
          <label for="precio_renta">Precio de renta<span style="color:red">*</span></label>
          <input type="number" class="form-control" name="precio_renta" id="precio_renta" placeholder="Ej. 4.99" step="0.01" required>
        </div>
        <div class="form-group">
          <label for="costo_remplazo">Costo de remplazo<span style="color:red">*</span></label>
          <input type="number" class="form-control" name="costo_remplazo" id="costo_remplazo" placeholder="Ej. 19.99" step="0.01" required>
        </div>
        <div class="form-group">
            <label for="clasificacion">Clasificación</label>
            <select name="clasificacion" id="clasificacion" class="form-control">
              <option value="G" selected>G</option>
              <option value="PG">PG</option>
              <option value="PG-13">PG-13</option>
              <option value="R">R</option>
              <option value="NC-17">NC-17</option>
            </select>
        </div>
        <br>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <input type="submit" class="form-control btn btn-outline-success" name="submit" value="Guardar">
            </div>
          </div>
          <div class="col-md-6">
            <a href="peliculas_show.php" class="form-control btn btn-outline-danger">Cancelar</a>
          </div>
        </div>
        <br>
      </form>
    </div>
    <script src="../js/bootstrap.min.js"></script>
  </body>
</html>
