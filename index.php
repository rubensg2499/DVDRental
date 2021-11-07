
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

$actores = @select_from(
  $conection, "actor",
  $columns = false, //array('actor_id', 'first_name'),
  $condition = false//"actor_id < 4"
);

/*if ($actores['success']) {
  echo $actores['message'];
  print_r($actores['result']);
}else {
  print_r($actores['message']);
}*/
$datos = array('first_name' => 'María', 'last_name' => 'Jiménez');
$response = @insert($conection, "actor", $datos);
//$response = update($conection, "actor", $datos, "actor_id = 200");
if($response['success']){
  print_r($response['result']);
  echo $response['message'];
}else {
  echo $response['message'];
}

?>
