
<?php
require_once("../conexion.php");
require_once("../constantes.php");
session_start();
if(!isset($_SESSION['staff_id'])){
  header('Location:../index.php');
}

$conection = @get_conection();

$clientes = @select_from(
  $conection, "customer",
  $columns = array('customer_id','store_id', 'first_name','last_name','email','address_id','activebool'),
  $condition = "customer_id > 0 ORDER BY last_update DESC"
);

//var_dump($clientes);
?>

<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Clientes</title>
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
            <a class="nav-link btn btn-primary" style="color:white" href="#">Clientes</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../Categorias/categorias_show.php">Categorías</a>
          </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
          <a class="btn btn-outline-danger" href="../salir.php">Salir</a>
        </form>
      </div>
    </nav>
    <!--Cuerpo del documento Lista de clientes-->
    <a href="clientes_create.php?action=create" class="btn btn-outline-success">Agregar nuevo cliente</a>

    <table class="table table-hover">
      <thead>
        <tr>
          <th scope="col">Nombre</th>
          <th scope="col">Apelidos</th>
          <th scope="col">Correo electrónico</th>
          <th scope="col">Id tienda</th>
          <th scope="col">Activo</th>
          <th scope="col">Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($clientes['result'] as $cliente): ?>
          <tr>
            <th scope="row"><?php echo $cliente['first_name']; ?></th>
            <td><?php echo $cliente['last_name']; ?></td>
            <td><?php echo $cliente['email']; ?></td>
            <td><?php echo $cliente['store_id']; ?></td>
            <td>
              <?php if ($cliente['activebool'] == 't'): ?>
                <input class="form-check-input" type="checkbox" checked disabled>
              <?php else: ?>
                <input class="form-check-input" type="checkbox" disabled>
              <?php endif; ?>
            </td>
            <td>
              <a href="clientes_update.php?id=<?php echo $cliente['customer_id']; ?>&action=update" class="btn btn-outline-success" style="margin-right:5px">Editar</a>
              <a href="#" onclick="eliminar(<?php echo $cliente['customer_id']; ?>)" class="btn btn-outline-danger" style="margin-right:5px">Eliminar</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <script src="../js/bootstrap.min.js"></script>
    <script type="text/javascript">
      function eliminar(id){
        if(confirm("¿Estás seguro de querer eliminar este registro?")){
          window.location.href = "clientes_delete.php?id="+id;
        }
      }
    </script>
  </body>
</html>
