
<?php
require_once("../conexion.php");
require_once("../constantes.php");
session_start();
if(!isset($_SESSION['staff_id'])){
  header('Location: index.php');
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
            <a class="nav-link btn btn-primary" style="color:white" href="clientes_show.php">Clientes</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../Categorias/categorias_show.php">Categorías</a>
          </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
          <a class="btn btn-outline-danger" href="salir.php">Salir</a>
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
        <?php
          foreach ($clientes['result'] as $cliente) {
            echo '<tr>';
              echo '<th scope="row">'.$cliente['first_name'].'</th>';
              echo '<td>'.$cliente['last_name'].'</td>';
              echo '<td>'.$cliente['email'].'</td>';
              echo '<td>'.$cliente['store_id'].'</td>';
              echo '<td>';
                echo '<div class="form-check form-switch">';
                if($cliente['activebool']=='t')
                  echo '<input class="form-check-input" type="checkbox" checked disabled>';
                else
                  echo '<input class="form-check-input" type="checkbox" disabled>';
                echo '</div>';
              echo '</td>';
              echo '<td>';
                //echo '<a href="#" class="btn btn-outline-primary" style="margin-right:5px">Ver</a>';
                echo '<a href="clientes_update.php?id='.$cliente['customer_id'].'&action=update" class="btn btn-outline-success" style="margin-right:5px">Editar</a>';
                echo '<a href="#" onclick="eliminar('.$cliente['customer_id'].')" class="btn btn-outline-danger" style="margin-right:5px">Eliminar</a>';
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
          window.location.href = "clientes_delete.php?id="+id;
        }
      }
    </script>
  </body>
</html>
