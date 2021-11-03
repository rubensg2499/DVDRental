<?php

// Nombre de la imagen
$path = 'Imagen.jpg';

// Extensión de la imagen
$type = pathinfo($path, PATHINFO_EXTENSION);

// Cargando la imagen
$data = file_get_contents($path);

// Decodificando la imagen en base64
$base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

// Mostrando la imagen
echo '<img src="'.$base64.'" width="200px"/>';

// Mostrando el código base64
//echo $base64;

?>
