<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Ventas</title>

  <link rel="stylesheet" href="./css/fontawesome-all.min.css">
  <link rel="stylesheet" href="./css/styles.css">

</head>

<body>
  <nav class="navbar-container">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">POS</a>
    </div>
    <div class="navbar-links">
      <ul>
        <a class="nav-link" href="./index.php">Productos</a>
        <a class="nav-link" href="./vender.php">Vender</a>
        <a class="nav-link" href="./ventas.php">Ventas</a>
      </ul>
    </div>
  </nav>
  <div class="main">
    <h1 class="title">Nuevo producto</h1>
    <form method="post" action="nuevo.php" class="form">
      <label for="codigo">Código de barras:</label>
      <input class="form-control" name="codigo" required type="text" id="codigo" placeholder="Escribe el código">

      <label for="descripcion">Descripción:</label>
      <textarea required id="descripcion" name="descripcion" cols="30" rows="5" class="form-control"></textarea>

      <label for="precioVenta">Precio de venta:</label>
      <input class="form-control" name="precioVenta" required type="number" id="precioVenta" placeholder="Precio de venta">

      <label for="precioCompra">Precio de compra:</label>
      <input class="form-control" name="precioCompra" required type="number" id="precioCompra" placeholder="Precio de compra">

      <label for="existencia">Existencia:</label>
      <input class="form-control" name="existencia" required type="number" id="existencia" placeholder="Cantidad o existencia">
      <br><br><input class="button btn-new" type="submit" value="Guardar">
    </form>
  </div>
</body>

</html>