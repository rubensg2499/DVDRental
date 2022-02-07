
<?php
require_once("../conexion.php");
require_once("../constantes.php");
session_start();
if(!isset($_SESSION['staff_id'])){
  header('Location:../index.php');
}

$conection = @get_conection();

$categorias = @select_from(
  $conection, "category",
  $columns = array('category_id','name', 'last_update'),
  $condition = "category_id > 0 ORDER BY last_update DESC"
);

//var_dump($categorias);
?>

<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Categorías</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/estilos.menu.css">
    <link rel="stylesheet" href="../css/master.css">
  </head>

  <body>
    <div class="container">
      <nav class="navbar navbar-expand-lg navbar-light">
      <a class="navbar-brand" href="../page_menu.php">DVDRental</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
          <li class="nav-item active">
            <a class="nav-link" href="../Peliculas/peliculas_show.php">Películas</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../Clientes/clientes_show.php">Clientes</a>
          </li>
          <li class="nav-item">
            <a class="nav-link btn btn-primary" style="color:white" href="#">Categorías</a>
          </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
          <a class="btn btn-outline-danger" href="../salir.php">Salir</a>
        </form>
      </div>
    </nav>
    <!--Cuerpo del documento Lista de clientes-->
    <a href="categorias_create.php?action=create" class="btn btn-outline-success">Agregar nueva categoría</a>

    <table class="table table-hover">
      <thead>
        <tr>
          <th scope="col">Id categoría</th>
          <th scope="col">Nombre</th>
          <th scope="col">Última actualización</th>
          <th scope="col">Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($categorias['result'] as $categoria): ?>
          <tr>
            <th scope="row"><?php echo $categoria['category_id']; ?></th>
            <td><?php echo $categoria['name']; ?></td>
            <td><?php echo preg_split("/[\ ]/",$categoria['last_update'])[0]; ?></td>
            <td>
              <a href="categorias_update.php?id=<?php echo $categoria['category_id']; ?>&action=update" class="btn btn-outline-success" style="margin-right:5px">Editar</a>
              <a href="#" onclick="eliminar(<?php echo $categoria['category_id']; ?>)" class="btn btn-outline-danger" style="margin-right:5px">Eliminar</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <script src="../js/bootstrap.min.js"></script>
    <script type="text/javascript">
      function eliminar(id){
        if(confirm("¿Estás seguro de querer eliminar este registro?")){
          window.location.href = "categorias_delete.php?id="+id;
        }
      }
    </script>
  </body>
</html>
