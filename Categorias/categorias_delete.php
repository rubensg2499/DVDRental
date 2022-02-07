<?php
  require_once("../conexion.php");

  $conection = @get_conection();
  $id = null;
  $film_category =  null;
  if(!empty($_GET['id'])){
    $id = $_GET['id'];

    $film_category = @select_from(
      $conection, "film_category",
      $columns = array('category_id'),
      $condition = "category_id = $id"
    );

    if(count($film_category['result']) == 0){
      $result = delete(
        $conection, "category", "category_id = $id"
      );
      header("Location:categorias_show.php");
    }
  }
 ?>

 <!DOCTYPE html>
 <html lang="es" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title>No se puede eliminar el registro</title>
     <link rel="stylesheet" href="../css/bootstrap.min.css">
     <link rel="stylesheet" href="../css/master.css">
   </head>
   <body>
     <div class="container">
       <br>
       <br>
       <div class="card" style="width: 18rem;">
        <div class="card-body">
          <h5 class="card-title">Advertencia</h5>
          <h6 class="card-subtitle mb-2 text-muted">Eliminación de categoría.</h6>
          <p class="card-text">No se puede eliminar la categoría con ID: <strong><?php echo "$id"; ?></strong> porque existen otros registros que hacen uso de ese ID, pruebe primero eliminando dichos registros o de otro modo configure el sistema para una eliminación en cascada.</p>
          <p>Descripción:</p>
          <?php if(count($film_category['result'])): ?>
              <p>Existen <strong><span style="color:red"><?php echo count($film_category['result']); ?></span></strong> registros dependientes en la tabla Película-Categoría.</p>
          <?php endif; ?>
          <a href="categorias_show.php" class="card-link">Volver</a>
        </div>
      </div>
     </div>
   </body>
 </html>
