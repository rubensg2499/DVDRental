<?php
//Funcion para conectarse a la base de datos
function get_conection(){
  $host = "localhost";
  $dbname = "DVDRental";
  $user = "postgres";
  $password = "postgres";
  $response = array('success' => false, 'message' => 'ERROR-CONNECTION', 'result' => NULL);
  $conection = pg_connect("host=$host dbname=$dbname user=$user password=$password");

  if($conection){
    $response['success'] = true;
    $response['message'] = 'Conexión a la base de datos exitosa.';
    $response['result'] = $conection;
  }else {
    $response['message'];
  }
  return $response;
}

//Función que ejecuta las sentencias SQL
function get_response($conection, $query, $type){
  $response = array('success' => false, 'message' => 'ERROR-CONNECTION', 'result' => NULL);
  $message = array(
    'SELECT' => "Registro obtenido de manera exitosa.",
    'INSERT' => "Registro guardado de manera exitosa.",
    'DELETE' => "Registro eliminado de manera exitosa.",
    'UPDATE' => "Registro actualizado de manera exitosa."
  );
  $q = pg_query($conection, $query);
  if($q){
    $response = array('success' => true, 'message' => $message[$type], 'result' => ($type == "SELECT") ? pg_fetch_all($q) : true);
    return $response;
  }
  $response['message'] = $type .'_'. pg_last_error($conection['result']);
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
  if($conection['success']){
      if($columns){
        $columns = get_columns($columns);
        if($condition) //Cuando hay columnas y condición.
          return get_response($conection['result'], "SELECT $cols FROM $table WHERE $condition", "SELECT");
        //Cuando solo hay columnas.
        return get_response($conection['result'], "SELECT $cols FROM $table", "SELECT");
      }
      if($condition) //Hay condición, pero no columnas
        return get_response($conection['result'], "SELECT * FROM $table WHERE $condition", "SELECT");
      //No hay condición ni columnas
      return get_response($conection['result'], "SELECT * FROM $table", "SELECT");
  }
  return $conection;
}

//Funcion para insertar datos en la base de datos.
function insert(
  $conection,
  $table,
  $columns_values
){
  $cols = "";
  $vals = "";
  foreach ($columns_values as $column => $value) {
    $cols .= $column . ", ";
    $vals .= (gettype($value)=='string' || gettype($value)=='boolean')? "'" . $value . "', " : $value . ", ";
  }
  $cols = substr($cols,0,-2);
  $vals = substr($vals,0,-2);
  if($conection['success']) //Insertar un registro
    return get_response($conection['result'], "INSERT INTO $table ($cols) VALUES ($vals)", "INSERT");
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
    if($condition) //Eliminar un registro a partir de una condición
      return get_response($conection['result'], "DELETE FROM $table WHERE $condition", "DELETE");
    //Eliminar todos los registros de una tabla
    return get_response($conection['result'], "DELETE FROM $table", "DELETE");
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
