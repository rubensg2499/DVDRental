<?php
session_start();
if(!isset($_SESSION['staff_id'])){
  header('Location: index.php');
}
?>

<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Menú DVDRental</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/estilos.menu.css">
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
            <a class="nav-link" href="Peliculas/peliculas_show.php">Películas</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="Cliente/clientes_show.php">Clientes</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="Categorias/categorias_show.php">Categorías</a>
          </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
          <a class="btn btn-outline-danger" href="salir.php">Salir</a>
        </form>
      </div>
    </nav>
    <!--Cuerpo del documento Imágenes de peliculas-->
      <div class="row" style="padding:10px">
        <div class="col">
          <img src="assets/images/1.jpg" alt="" class="rounded mx-auto d-block">
        </div>
        <div class="col">
          <img src="assets/images/2.jpg" alt="" class="rounded mx-auto d-block">
        </div>
        <div class="col">
          <img src="assets/images/3.jpg" alt="" class="rounded mx-auto d-block">
        </div>
      </div>
      <div class="row" style="padding:10px">
        <div class="col">
          <img src="assets/images/4.jpg" alt="" class="rounded mx-auto d-block">
        </div>
        <div class="col">
          <img src="assets/images/5.jpg" alt="" class="rounded mx-auto d-block">
        </div>
        <div class="col">
          <img src="assets/images/6.jpg" alt="" class="rounded mx-auto d-block">
        </div>
      </div>
      <div class="row" style="padding:10px">
        <div class="col">
          <img src="assets/images/7.jpg" alt="" class="rounded mx-auto d-block">
        </div>
        <div class="col">
          <img src="assets/images/8.jpg" alt="" class="rounded mx-auto d-block">
        </div>
        <div class="col">
          <img src="assets/images/9.jpg" alt="" class="rounded mx-auto d-block">
        </div>
      </div>
      <div class="row" style="padding:10px">
        <div class="col">
          <img src="assets/images/10.jpg" alt="" class="rounded mx-auto d-block">
        </div>
        <div class="col">
          <img src="assets/images/11.jpg" alt="" class="rounded mx-auto d-block">
        </div>
        <div class="col">
          <img src="assets/images/12.jpg" alt="" class="rounded mx-auto d-block">
        </div>
      </div>
    </div>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
