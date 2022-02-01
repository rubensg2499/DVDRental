<form method="POST" action="">
  <div class="form-group">
    <label for="titulo">Título<span style="color:red">*</span></label>
    <input type="text" class="form-control" name="titulo" id="titulo" placeholder="Ej. Las aventuras de Aladino" required>
  </div>
  <div class="form-group">
    <label for="descripcion">Descripción</label>
    <textarea class="form-control" name="descripcion" id="descripcion" placeholder="Ej. Una película de aventuras donde..."></textarea>
  </div>
  <div class="form-group">
    <label for="anyo">Año de estreno<span style="color:red">*</span></label>
    <input type="number" class="form-control" name="anyo" id="anyo" min="1800" max="3000" placeholder="Ej. 2015" required>
  </div>
  <div class="form-group">
      <label for="idioma">Idioma<span style="color:red">*</span></label>
      <select name="idioma" id="idioma" class="form-control" required>
        <?php
        foreach ($idiomas['result'] as $idioma) {
            echo '<option value="'.$idioma['language_id'].'">'.$idioma['name'].'</option>';
        }
         ?>
      </select>
  </div>
  <div class="form-group">
    <label for="duracion_renta">Duración de renta<span style="color:red">*</span></label>
    <input type="number" class="form-control" name="duracion_renta" id="duracion_renta" placeholder="Ej. 5" required>
  </div>
  <div class="form-group">
    <label for="precio_renta">Precio de renta<span style="color:red">*</span></label>
    <input type="number" class="form-control" name="precio_renta" id="precio_renta" placeholder="Ej. 4.99" step="0.01" required>
  </div>
  <div class="form-group">
    <label for="costo_remplazo">Costo de remplazo<span style="color:red">*</span></label>
    <input type="number" class="form-control" name="costo_remplazo" id="costo_remplazo" placeholder="Ej. 19.99" step="0.01" required>
  </div>
  <div class="form-group">
      <label for="clasificacion">Clasificación</label>
      <select name="clasificacion" id="clasificacion" class="form-control">
        <option value="G" selected>G</option>
        <option value="PG">PG</option>
        <option value="PG-13">PG-13</option>
        <option value="R">R</option>
        <option value="NC-17">NC-17</option>
      </select>
  </div>
  <br>
  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <input type="submit" class="form-control btn btn-success" name="submit" value="Guardar">
      </div>
    </div>
    <div class="col-md-6">
      <a href="peliculas_show.php" class="form-control btn btn-danger">Cancelar</a>
    </div>
  </div>
  <br>
</form>
