<?php
require_once("../conexion.php");
session_start();
if(!isset($_SESSION['staff_id'])){
  header('Location:../index.php');
}
$conection = @get_conection();
if ($conection['success']) {
  $record = array('success' => false);
  $id = $_GET['id'];

  if(!empty($_GET['action']) && $_GET['action'] == 'update'){
    $id = $_GET['id'];
    $record = @select_from(
      $conection, "category",
      $columns = array(
        'category_id',
        'name',
        'last_update'
      ),
      $condition = "category_id = $id"
    );

    if(!$record['success'])
      header("Location:categorias_show.php");
    else
      $record = $record['result'][0];
  }

  //Al guardar
  if(isset($_POST['submit']) && !empty($_POST['nombre'])){
    $categoria = array(
      'name' => $_POST['nombre']
    );

    $response = @update(
      $conection, "category", $categoria, $condition="category_id = $id"
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
    <title>Editar categoría</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/master.css">
  </head>
  <body>
    <div class="container" style="max-width: 500px">
      <div class="">
        <h3 class="text-align-center">Editar categoría</h2>
      </div>
      <form method="POST" action="">
        <div class="form-group">
          <label for="id_categoria">Id categoría<span style="color:red">*</span></label>
          <input type="text" class="form-control" id="id_categoria" value="<?php echo $record['category_id']; ?>" readonly>
        </div>
        <div class="form-group">
          <label for="nombre">Categoría<span style="color:red">*</span></label>
          <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Ej. Acción" value="<?php echo $record['name']; ?>" required>
        </div>
        <div class="form-group">
          <label for="last_update">Última actualización<span style="color:red">*</span></label>
          <input type="text" class="form-control" id="last_update" placeholder="Ej. email@domail.com" value="<?php echo preg_split("/[\ ]/",$record['last_update'])[0]; ?>" readonly>
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
