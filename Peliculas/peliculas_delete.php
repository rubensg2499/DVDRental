<?php
  require_once("../conexion.php");

  $conection = @get_conection();
  $id = null;
  $inventory = null;
  $film_actor = null;
  $film_category = null;
  if(!empty($_GET['id'])){
    $id = $_GET['id'];

    $inventory = @select_from(
      $conection, "inventory",
      $columns = array('inventory_id'),
      $condition = "film_id = $id"
    );

    $film_actor = @select_from(
      $conection, "film_actor",
      $columns = array('film_id'),
      $condition = "film_id = $id"
    );

    $film_category = @select_from(
      $conection, "film_category",
      $columns = array('film_id'),
      $condition = "film_id = $id"
    );

    if(count($inventory['result']) == 0 && count($film_actor['result'])== 0 && count($film_category['result']) == 0){
      $result = @delete(
        $conection, "film", "film_id = $id"
      );
      header("Location:peliculas_show.php");
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
          <h6 class="card-subtitle mb-2 text-muted">Eliminación de película.</h6>
          <p class="card-text">No se puede eliminar la película con ID: <strong><?php echo "$id"; ?></strong> porque existen otros registros que hacen uso de ese ID, pruebe primero eliminando dichos registros o de otro modo configure el sistema para una eliminación en cascada.</p>
          <p>Descripción:</p>
          <?php if(count($inventory['result'])): ?>
              <p>Existen <strong><span style="color:red"><?php echo count($inventory['result']); ?></span></strong> registros dependientes en la tabla Inventario.</p>
          <?php endif; ?>
          <?php if(count($film_actor['result'])): ?>
              <p>Existen <strong><span style="color:red"><?php echo count($film_actor['result']); ?></span></strong> registros dependientes en la tabla Película-Actor.</p>
          <?php endif; ?>
          <?php if(count($film_category['result'])): ?>
              <p>Existen <strong><span style="color:red"><?php echo count($film_category['result']); ?></span></strong> registros dependientes en la tabla Película-Categoría.</p>
          <?php endif; ?>
          <a href="peliculas_show.php" class="card-link">Volver</a>
        </div>
      </div>
     </div>
   </body>
 </html>
