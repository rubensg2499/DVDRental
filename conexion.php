<?php
//Funcion para conectarse a la base de datos
function get_conection(){
  try {
    $conection = pg_connect("host=localhost dbname=DVDRental user=postgres password=postgres");
    return $conection;
  } catch (\Exception $e) {
    echo "Error en la conexión a la base de datos: " . $e.getMessage();
  }
  return false;
}

//Funcion para seleccionar datos de la base de datos
function select(){

}
function select_all($conection, $table){
  if($conection){
    try {
      $query = pg_query($conection, "SELECT * FROM $table");
      return pg_fetch_all($query);
    } catch (\Exception $e) {
      echo "Error al obtener datos: " . $e.getMessage;
    }
    return false;
  }

}
?>
