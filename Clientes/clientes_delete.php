<?php
  require_once("../conexion.php");
  session_start();
  if(!isset($_SESSION['staff_id'])){
    header('Location:../index.php');
  }
  $conection = @get_conection();
  $id = null;
  $rental =  null;
  $payment = null;
  if(!empty($_GET['id'])){
    $id = $_GET['id'];

    $rental = @select_from(
      $conection, "rental",
      $columns = array('rental_id'),
      $condition = "customer_id = $id"
    );

    $payment = @select_from(
      $conection, "payment",
      $columns = array('payment_id'),
      $condition = "customer_id = $id"
    );

    if(count($rental['result']) == 0 && count($payment['result']) == 0){
      $result = delete(
        $conection, "customer", "customer_id = $id"
      );
      header("Location:clientes_show.php");
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
          <h6 class="card-subtitle mb-2 text-muted">Eliminación de cliente.</h6>
          <p class="card-text">No se puede eliminar el cliente con ID: <strong><?php echo "$id"; ?></strong> porque existen otros registros que hacen uso de ese ID, pruebe primero eliminando dichos registros o de otro modo configure el sistema para una eliminación en cascada.</p>
          <p>Descripción:</p>
          <?php if(count($rental['result'])): ?>
              <p>Existen <strong><span style="color:red"><?php echo count($rental['result']); ?></span></strong> registros dependientes en la tabla Renta.</p>
          <?php endif; ?>
          <?php if(count($payment['result'])): ?>
              <p>Existen <strong><span style="color:red"><?php echo count($payment['result']); ?></span></strong> registros dependientes en la tabla Pago.</p>
          <?php endif; ?>
          <a href="clientes_show.php" class="card-link">Volver</a>
        </div>
      </div>
     </div>
   </body>
 </html>
