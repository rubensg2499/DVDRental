<?php
require_once("../conexion.php");
$conection = @get_conection();
if ($conection['success']) {
  $direcciones = @select_from(
    $conection, "address",
    $columns = array('address_id', 'address', 'district', 'postal_code'),
    $condition = "address_id > 0 ORDER BY address"
  );
  $tiendas = @select_from(
    $conection, "store",
    $columns = array('store_id'),
    $condition = "store_id > 0 ORDER BY store_id"
  );
  $edit = false;
  //Al guardar
  if(isset($_POST['submit']) && !empty($_POST['nombre']) &&
    !empty($_POST['apellidos']) && !empty($_POST['direccion']) &&
    !empty($_POST['tienda'])
  ){
    $cliente = array(
      'first_name' => $_POST['nombre'],
      'last_name' => $_POST['apellidos'],
      'address_id' => (int)$_POST['direccion'],
      'store_id' => (int)$_POST['tienda'],
      'email' => $_POST['correo'],
      'activebool' => isset($_POST['activo']) ? 'true' : 'false'
    );

    $response = insert(
      $conection, "customer", $cliente
    );
    if($response['success']){
      header('Location:clientes_show.php');
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
    <title>Agregar nuevo cliente</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/master.css">
  </head>
  <body>
    <div class="container" style="max-width: 500px">
      <div class="">
        <h3 class="text-align-center">Agregar nuevo cliente</h2>
      </div>
      <form method="POST" action="">
        <div class="form-group">
          <label for="nombre">Nombre<span style="color:red">*</span></label>
          <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Ej. Rubén" pattern="^[A-Za-záéíóúÁÉÍÓÚ ]+$" required>
        </div>
        <div class="form-group">
          <label for="apellidos">Apellidos</label>
          <input type="text" class="form-control" name="apellidos" id="apellidos" placeholder="Ej. Sánchez González" pattern="^[A-Za-záéíóúÁÉÍÓÚ ]+$" required>
        </div>
        <div class="form-group">
          <label for="correo">Correo electrónico</label>
          <input type="email" class="form-control" name="correo" id="correo" placeholder="Ej. email@domail.com" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$">
        </div>
        <div class="form-group">
            <label for="direccion">Dirección<span style="color:red">*</span></label>
            <select name="direccion" id="direccion" class="form-control" required>
              <?php foreach ($direcciones['result'] as $direccion):?>
                <option value="<?php echo $direccion['address_id']; ?>"><?php echo $direccion['address'].', '.$direccion['district'].', '.$direccion['postal_code']; ?></option>
              <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="tienda">Id tienda<span style="color:red">*</span></label>
            <select name="tienda" id="tienda" class="form-control" required>
              <?php foreach ($tiendas['result'] as $tienda):?>
                <option value="<?php echo $tienda['store_id']; ?>"><?php echo $tienda['store_id']; ?></option>
              <?php endforeach; ?>
            </select>
        </div>
        <br>
        <div class="form-group">
          <label for="activo">¿El cliente está activo?<span style="color:red">*</span></label>
          <input class="form-check-input" type="checkbox" name="activo" id="activo">
        </div>
        <br>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <input type="submit" class="form-control btn btn-outline-success" name="submit" value="Guardar">
            </div>
          </div>
          <div class="col-md-6">
            <a href="clientes_show.php" class="form-control btn btn-outline-danger">Cancelar</a>
          </div>
        </div>
        <br>
      </form>
    </div>
    <script src="../js/bootstrap.min.js"></script>
  </body>
</html>
