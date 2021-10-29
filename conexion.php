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
function get_columns($columns){
  $param = "";
  foreach ($columns as $column) {
    $param .= $column . ", ";
  }
  return substr($param, 0, -2);
}
//Funcion para seleccionar datos de ciertas columnas de la base de datos
function select_from(
  $conection, //Conexion con la base de datos.
  $table,  //Nombre de la tabla.
  $columns=false, //columnas a buscar, por defecto son todas.
  $condition=false //Condición para buscar, por defecto no hay Condición.
){
  $cols = "";
  if($columns){
    $cols = get_columns($columns);
  }
  if($conection){
    try {
      if($columns){
        if($condition){
          $query = pg_query($conection, "SELECT $cols FROM $table WHERE $condition");
          return pg_fetch_all($query);
        }
        $query = pg_query($conection, "SELECT $cols FROM $table");
        return pg_fetch_all($query);
      }
      if($condition){
        $query = pg_query($conection, "SELECT * FROM $table WHERE $condition");
        return pg_fetch_all($query);
      }
      $query = pg_query($conection, "SELECT * FROM $table");
      return pg_fetch_all($query);

    } catch (\Exception $e) {
      echo "Error al obtener datos: " . $e.getMessage;
    }
    return false;
  }
}

?>
