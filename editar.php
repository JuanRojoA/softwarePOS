<?php
if (!isset($_GET["id"])) exit();
$id = $_GET["id"];
include_once "base_de_datos.php";
$sentencia = $base_de_datos->prepare("SELECT * FROM productos WHERE id = ?;");
$sentencia->execute([$id]);
$producto = $sentencia->fetch(PDO::FETCH_OBJ);
if ($producto === FALSE) {
  echo "¡No existe algún producto con ese ID!";
  exit();
}
?>

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
    <h1 class="title">Editar producto con el ID <?php echo $producto->id; ?></h1>
    <form method="post" action="guardarDatosEditados.php" class="form">
      <input type="hidden" name="id" value="<?php echo $producto->id; ?>">

      <label for="codigo">Código de barras:</label>
      <input value="<?php echo $producto->codigo ?>" class="form-control" name="codigo" required type="text" id="codigo" placeholder="Escribe el código">

      <label for="descripcion">Descripción:</label>
      <textarea required id="descripcion" name="descripcion" cols="30" rows="5" class="form-control"><?php echo $producto->descripcion ?></textarea>

      <label for="precioVenta">Precio de venta:</label>
      <input value="<?php echo $producto->precioVenta ?>" class="form-control" name="precioVenta" required type="number" id="precioVenta" placeholder="Precio de venta">

      <label for="precioCompra">Precio de compra:</label>
      <input value="<?php echo $producto->precioCompra ?>" class="form-control" name="precioCompra" required type="number" id="precioCompra" placeholder="Precio de compra">

      <label for="existencia">Existencia:</label>
      <input value="<?php echo $producto->existencia ?>" class="form-control" name="existencia" required type="number" id="existencia" placeholder="Cantidad o existencia">
      <br><br><input class="button btn-new" type="submit" value="Guardar">
      <a class="button btn-delete" href="./listar.php">Cancelar</a>
    </form>
  </div>
</body>

</html>