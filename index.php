
<?php
require_once("conexion.php");
require_once("constantes.php");
$conection = get_conection();
if($conection['success']){
  //Haga el código.
  echo $conection['message'];
}else {
  echo $conection['message'];
}
/*$actores = select_from($conection,"actor", $columns=false, $condition=false);
if ($actores['success']) {
  print_r($actores['result']);
}else {
  print_r($actores['message']); Thora Temple
}*/
$datos = array('first_name' => 'Thora', 'last_name' => 'Temple');
$response = update($conection, "actor", $datos, "actor_id = 200");
if($response['success']){
  echo $response['message'];
}else {
  echo $response['message'];
}

?>
