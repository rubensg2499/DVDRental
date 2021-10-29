<?php
//Funcion para conectarse a la base de datos
function get_conection(){
  $response = array('success' => false, 'message' => 'Error conexion: ', 'result' => NULL);
  try {
    $conection = pg_connect("host=localhost dbname=DVDRental user=postgres password=postgres");
    if($conection){
      $response['success'] = true;
      $response['message'] = 'Conexión a la base de datos exitosa.';
      $response['result'] = $conection;
    }
  } catch (\Exception $e) {
    $response['message'] .= $e.getMessage();
  }
  return $response;
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
  $message = "Error al insertar el registro.";
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

//Funcion para eliminar datos de la base de datos.
function delete(
  $conection,
  $table,
  $condition=false
){
  $message = "Error al eliminar el registro.";
  if($conection['success']){
    try {
      if($condition){
        $query = pg_query($conection['result'], "DELETE FROM $table WHERE $condition");
        $message = "Registro eliminado correctamente.";
        return array('success' => true, 'message' => $message);
      }
      $query = pg_query($conection['result'], "DELETE FROM $table");
      $message = "Registro eliminado correctamente.";
      return array('success' => true, 'message' => $message);
    } catch (\Exception $e) {
        $message = "Error al eliminar el registro: " . $e.getMessage;
    }
    return array('success' => false, 'message' => $message);
  }
  return $conection;
}

function update(
  $conection,
  $table,
  $columns_values,
  $condition = false
){
  $message = "Error al actualizar el registro.";
  $cols_vals = "";
  foreach ($columns_values as $column => $value) {
    $cols_vals .= $column . " = ";
    $cols_vals .= (gettype($value)=='string' || gettype($value)=='boolean')? "'" . $value . "', " : $value . ", ";
  }
  $cols_vals = substr($cols_vals,0,-2);

  if($conection['success']){
    try {
      if ($condition) {
        $query = pg_query($conection['result'], "UPDATE $table SET $cols_vals WHERE $condition");
        $message = "Registro actualizado correctamente.";
        return array('success' => true, 'message' => $message);
      }
      $query = pg_query($conection['result'], "UPDATE $table SET $cols_vals");
      $message = "Registro actualizado correctamente.";
      return array('success' => true, 'message' => $message);
    } catch (\Exception $e) {
      $message = "Error al actualizar el registro: " . $e.getMessage;
    }
    return array('success' => false, 'message' => $message);
  }
  return $conection;
}
?>
