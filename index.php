
<?php
require_once("conexion.php");
$conection = get_conection();

$actores = select_all($conection,"actor");
print_r($actores);

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página principal</title>
</head>
<body>

</body>
</html>
