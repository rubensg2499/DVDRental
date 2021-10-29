<?php
//Funcion para conectarse a la base de datos
function get_conection(){
  $message = "";
  try {
    $conection = pg_connect("host=localhost dbname=DVDRental user=postgres password=postgres");
    return array('success' => true, 'message' => 'Conexión a la base de datos exitosa.', 'result' => $conection);
  } catch (\Exception $e) {
    $message = "Error en la conexión a la base de datos: " . $e.getMessage();
  }
  return array('success' => false, 'message' => $message);
}

//Función para obtener la columnas de un arreglo.
function get_columns($columns){
  $param = "";
  foreach ($columns as $column) {
    $param .= $column . ", ";
  }
  return substr($param, 0, -2);
}

//Funcion para obtener datos la base de datos.
function select_from(
  $conection, //Conexion con la base de datos.
  $table,  //Nombre de la tabla.
  $columns=false, //columnas a buscar, por defecto son todas.
  $condition=false //Condición para buscar, por defecto no hay Condición.
){
  $message = "Registros obtenidos de manera exitosa.";
  $cols = "";
  if($columns){
    $cols = get_columns($columns);
  }
  if($conection['success']){
    try {
      if($columns){
        if($condition){
          $query = pg_query($conection['result'], "SELECT $cols FROM $table WHERE $condition");
          return array('success' => true, 'result' => pg_fetch_all($query));
        }
        $query = pg_query($conection['result'], "SELECT $cols FROM $table");
        return array('success' => true, 'result' => pg_fetch_all($query));
      }
      if($condition){
        $query = pg_query($conection['result'], "SELECT * FROM $table WHERE $condition");
        return array('success' => true, 'result' => pg_fetch_all($query));
      }
      $query = pg_query($conection['result'], "SELECT * FROM $table");
      return array('success' => true, 'result' => pg_fetch_all($query));

    } catch (\Exception $e) {
      $message = "Error al obtener datos: " . $e.getMessage();
    }
    return array('success' => false, 'message' => $message);
  }
  return $conection;
}

//Funcion para insertar datos en la base de datos.
function insert(
  $conection,
  $table,
  $columns_values
){
  $message = "";
  $cols = "";
  $vals = "";
  foreach ($columns_values as $column => $value) {
    $cols .= $column . ", ";
    $vals .= (gettype($value)=='string' || gettype($value)=='boolean')? "'" . $value . "', " : $value . ", ";
  }
  $cols = substr($cols,0,-2);
  $vals = substr($vals,0,-2);
  if($conection['success']){
    try {
      $query = pg_query($conection['result'], "INSERT INTO $table ($cols) VALUES ($vals)");
      $message = "Se insertó el registro correctamente.";
      return array('success' => true, 'message' => $message);
    } catch (\Exception $e) {
      $message = "Error al insertar el registro: " . $e.getMessage;
    }
    return array('success' => false, 'message' => $message);
  }
  return $conection;
}
?>
