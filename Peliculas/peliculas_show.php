
<?php
require_once("../conexion.php");
require_once("../constantes.php");
session_start();
if(!isset($_SESSION['staff_id'])){
  header('Location: index.php');
}

$conection = @get_conection();

$peliculas = @select_from(
  $conection, "film",
  $columns = array('film_id','title', 'description','release_year','rating'),
  $condition = "film_id > 0 ORDER BY last_update DESC"
);

//var_dump($peliculas);
?>

<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Menú DVDRental</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/estilos.menu.css">
  </head>

  <body>
    <div class="container">
      <nav class="navbar navbar-expand-lg navbar-light">
      <a class="navbar-brand" href="#">DVDRental</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
          <li class="nav-item active">
            <a class="nav-link btn btn-success" style="color:white" href="peliculas_show.php">Películas</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="clientes_show.php">Clientes</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="categorias_show.php">Categorías</a>
          </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
          <a class="btn btn-outline-danger" href="salir.php">Salir</a>
        </form>
      </div>
    </nav>
    <!--Cuerpo del documento Lista de peliculas-->
    <a href="peliculas_create.php?action=create" class="btn btn-outline-success">Agregar nueva película</a>

    <table class="table table-hover">
      <thead>
        <tr>
          <th scope="col">Título</th>
          <th scope="col">Descripción</th>
          <th scope="col">Año</th>
          <th scope="col">Clasificación</th>
          <th scope="col">Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php
          foreach ($peliculas['result'] as $pelicula) {
            echo '<tr>';
              echo '<th scope="row">'.$pelicula['title'].'</th>';
              echo '<td style="width:490px">'.$pelicula['description'].'</td>';
              echo '<td>'.$pelicula['release_year'].'</td>';
              echo '<td>'.$pelicula['rating'].'</td>';
              echo '<td>';
                //echo '<a href="#" class="btn btn-outline-primary" style="margin-right:5px">Ver</a>';
                echo '<a href="peliculas_update.php?id='.$pelicula['film_id'].'&action=update" class="btn btn-outline-success" style="margin-right:5px">Editar</a>';
                echo '<a href="#" onclick="eliminar('.$pelicula['film_id'].')" class="btn btn-outline-danger" style="margin-right:5px">Eliminar</a>';
              echo '</td>';
            echo '</tr>';
          }
         ?>
      </tbody>
    </table>
    <script src="../js/bootstrap.min.js"></script>
    <script type="text/javascript">
      function eliminar(id){
        if(confirm("¿Estás seguro de querer eliminar este registro?")){
          window.location.href = "peliculas_delete.php?id="+id;
        }
      }
    </script>
  </body>
</html>
