
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
//$actores = select_from($conection,"actor", $columns=false, "actor_id < 32");
/*if ($actores['success']) {
  print_r($actores['result']);
}else {
  print_r($actores['message']);
}*/
$datos = array('first_name' => 'Rubén', 'last_name' => 'Sánchez');
$response = insert($conection, "actor", $datos);
if($response['success']){
  echo $response['message'];
}else {
  echo $response['message'];
}

?>
