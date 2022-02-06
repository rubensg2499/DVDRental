<?php
require_once("../conexion.php");
$conection = @get_conection();
if ($conection['success']) {
  $idiomas = @select_from(
    $conection, "language",
    $columns = array('language_id', 'name'),
    $condition = "language_id > 0 ORDER BY name"
  );
  $clasificaciones = array(
    'G','PG','PG-13','R','NC-17'
  );
  $record = array('success' => false);
  $id = $_GET['id'];
  if(!empty($_GET['action']) && $_GET['action'] == 'update'){
    $id = $_GET['id'];
    $record = @select_from(
      $conection, "film",
      $columns = array(
        'film_id',
        'title',
        'description',
        'release_year',
        'language_id',
        'rental_duration',
        'rental_rate',
        'replacement_cost',
        'rating'
      ),
      $condition = "film_id = $id"
    );

    if(!$record['success'])
      header("Location: peliculas_show.php");
    else
      $record = $record['result'][0];
  }

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

    $response = @update(
      $conection, "film", $pelicula, $condition="film_id=$id"
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
    <title>Editar película</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/master.css">
  </head>
  <body>
    <div class="container" style="max-width: 500px">
      <div class="">
        <h3 class="text-align-center">Editar película</h2>
      </div>
      <form method="POST" action="">
        <div class="form-group">
          <label for="titulo">Título<span style="color:red">*</span></label>
          <input type="text" class="form-control" name="titulo" id="titulo" placeholder="Ej. Las aventuras de Aladino" required value="<?php echo $record['title']; ?>">
        </div>
        <div class="form-group">
          <label for="descripcion">Descripción</label>
          <textarea class="form-control" name="descripcion" id="descripcion" placeholder="Ej. Una película de aventuras donde..."><?php echo $record['description']; ?></textarea>
        </div>
        <div class="form-group">
          <label for="anyo">Año de estreno<span style="color:red">*</span></label>
          <input type="number" class="form-control" name="anyo" id="anyo" min="1800" max="3000" placeholder="Ej. 2015" required value="<?php echo $record['release_year']; ?>">
        </div>
        <div class="form-group">
            <label for="idioma">Idioma<span style="color:red">*</span></label>
            <select name="idioma" id="idioma" class="form-control" required>
              <?php
              foreach ($idiomas['result'] as $idioma) {
                  if($idioma['language_id'] == $record['language_id'])
                    echo '<option value="'.$idioma['language_id'].'" selected>'.$idioma['name'].'</option>';
                  else
                    echo '<option value="'.$idioma['language_id'].'">'.$idioma['name'].'</option>';
              }
               ?>
            </select>
        </div>
        <div class="form-group">
          <label for="duracion_renta">Duración de renta<span style="color:red">*</span></label>
          <input type="number" class="form-control" name="duracion_renta" id="duracion_renta" placeholder="Ej. 5" required value="<?php echo $record['rental_duration']; ?>">
        </div>
        <div class="form-group">
          <label for="precio_renta">Precio de renta<span style="color:red">*</span></label>
          <input type="number" class="form-control" name="precio_renta" id="precio_renta" placeholder="Ej. 4.99" step="0.01" required value="<?php echo $record['rental_rate']; ?>">
        </div>
        <div class="form-group">
          <label for="costo_remplazo">Costo de remplazo<span style="color:red">*</span></label>
          <input type="number" class="form-control" name="costo_remplazo" id="costo_remplazo" placeholder="Ej. 19.99" step="0.01" required value="<?php echo $record['replacement_cost']; ?>">
        </div>
        <div class="form-group">
            <label for="clasificacion">Clasificación</label>
            <select name="clasificacion" id="clasificacion" class="form-control">
              <?php
                foreach ($clasificaciones as $clasificacion) {
                  if($clasificacion == $record['rating'])
                    echo '<option value="'.$clasificacion.'" selected>'.$clasificacion.'</option>';
                  else
                    echo '<option value="'.$clasificacion.'">'.$clasificacion.'</option>';
                }
               ?>
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
