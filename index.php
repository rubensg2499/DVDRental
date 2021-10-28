
<?php
echo "Hola mundo";
//Ejemplo de conexión de php con postgres
$conexion = pg_connect("host=localhost dbname=dvdrental user=postgres password=postgres");
$consulta  = pg_query($conexion, "SELECT * FROM actor");
if($conexion){
    echo "Correcto\n";
    $arr = pg_fetch_all($consulta);
    print_r($arr);
    
}else{
    echo "Error";
}
echo "hola mundo 2";