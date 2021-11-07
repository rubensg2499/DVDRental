
<?php
require_once("conexion.php");
require_once("constantes.php");
$conection = @get_conection();

if($conection['success']){
  //Haga el código.
  echo $conection['message'];
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
    <title></title>
  </head>
  <body>

  </body>
</html>
