
<?php
require_once("conexion.php");
require_once("constantes.php");
session_start();
$conection = @get_conection();

if($conection['success']){
  if(!isset($_POST)){
    $user =  $_POST['user'];
    $password = $_POST['password'];

    $acceso = select_from(
      $conection, 'staff',
      $columns = array('staff_id'),
      $condition = "username = '$user' AND password = '$password'"
    );

    if($acceso['success'] && !empty($acceso['result'])){
      $_SESSION['staff_id'] = $acceso['result'][0]['staff_id'];
      header('Location: page_menu.php');
    }else {
      echo "Error no existe el usuario o la contraseña";
    }
  }
}else {
  echo $conection['message'];
}
/*
$actores = @select_from(
  $conection, "actor",
  $columns = false, //array('actor_id', 'first_name'),
  $condition = false//"actor_id < 4"
);

if ($actores['success']) {
  echo $actores['message'];
  print_r($actores['result']);
}else {
  print_r($actores['message']);
}*/

/*
$datos = array('address' => 'Dirección', 'district' => 'Distrito', 'postal_code' => '70710', 'city_id'=>38, 'phone'=>'9163415385');
$response = @insert($conection, "address", $datos);
//$response = update($conection, "actor", $datos, "actor_id = 200");
if($response['success']){
  print_r($response['result']);
  echo $response['message'];
}else {
  echo $response['message'];
}
*/
/*
$response = @delete($conection, "actor", "actor_id IN (206, 207)");
if($response['success']){
  print_r($response['result']);
  echo $response['message'];
}else {
  echo $response['message'];
}*/

/*
$response = @update(
  $conection, "actor",
  array('first_name' => 'Ernesto', 'last_name' => 'Alonso'),
  "actor_id = 201"
);
if($response['success']){
  print_r($response['result']);
  echo $response['message'];
}else {
  echo $response['message'];
}*/
?>
<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/estilos.login.css">
    <title>Login</title>
  </head>
  <body>
    <div class="container">
      <div class="m-0 vh-100 row justify-content-center align-items-center">
        <div class="col-md-4 text-center login-form-1">
            <h3>Login DVD Rental</h3>
            <br>
            <form action="index.php" method="post">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Usuario" name="user" />
                </div>
                <br>
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="Contraseña" name="password" />
                </div>
                <br>
                <div class="form-group">
                    <input type="submit" class="btnSubmit" value="Login" />
                </div>
            </form>
        </div>
      </div>
    </div>
  </body>
  <script src="js/bootstrap.min.js" charset="utf-8"></script>
</html>
