<?php
session_start();

if (!isset($_SESSION["carrito"])) $_SESSION["carrito"] = [];
$granTotal = 0;
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
    <h1 class="title">Vender</h1>
    <?php
    if (isset($_GET["status"])) {
      if ($_GET["status"] === "1") {
    ?>
        <div class="alert alert-success">
          <strong>¡Correcto!</strong> Venta realizada correctamente
        </div>
      <?php
      } else if ($_GET["status"] === "2") {
      ?>
        <div class="alert alert-info">
          <strong>Venta cancelada</strong>
        </div>
      <?php
      } else if ($_GET["status"] === "3") {
      ?>
        <div class="alert alert-info">
          <strong>Ok</strong> Producto quitado de la lista
        </div>
      <?php
      } else if ($_GET["status"] === "4") {
      ?>
        <div class="alert alert-warning">
          <strong>Error:</strong> El producto que buscas no existe
        </div>
      <?php
      } else if ($_GET["status"] === "5") {
      ?>
        <div class="alert alert-danger">
          <strong>Error: </strong>El producto está agotado
        </div>
      <?php
      } else {
      ?>
        <div class="alert alert-danger">
          <strong>Error:</strong> Algo salió mal mientras se realizaba la venta
        </div>
    <?php
      }
    }
    ?>
    <br>
    <form method="post" action="agregarAlCarrito.php">
      <label for="codigo">Código de barras:</label>
      <input autocomplete="off" autofocus class="form-control" name="codigo" required type="text" id="codigo" placeholder="Escribe el código" class="input">
    </form>
    <br><br>
    <table class="table">
      <thead class="table-head">
        <tr>
          <th>ID</th>
          <th>Código</th>
          <th>Descripción</th>
          <th>Precio de venta</th>
          <th>Cantidad</th>
          <th>Total</th>
          <th>Quitar</th>
        </tr>
      </thead>
      <tbody class="table-body">
        <?php foreach ($_SESSION["carrito"] as $indice => $producto) {
          $granTotal += $producto->total;
        ?>
          <tr>
            <td><?php echo $producto->id ?></td>
            <td><?php echo $producto->codigo ?></td>
            <td><?php echo $producto->descripcion ?></td>
            <td><?php echo $producto->precioVenta ?></td>
            <td>
              <form action="cambiar_cantidad.php" method="post">
                <input name="indice" type="hidden" value="<?php echo $indice; ?>">
                <input min="1" name="cantidad" class="form-control" required type="number" step="0.1" value="<?php echo $producto->cantidad; ?>">
              </form>
            </td>
            <td><?php echo $producto->total ?></td>
            <td><a class="btn btn-danger" href="<?php echo "quitarDelCarrito.php?indice=" . $indice ?>"><i class="fa fa-trash"></i></a></td>
          </tr>
        <?php } ?>
      </tbody>
    </table>

    <h3 style="margin: 10px 0;">Total: <?php echo $granTotal; ?></h3>
    <form action="./terminarVenta.php" method="POST">
      <input name="total" type="hidden" value="<?php echo $granTotal; ?>">
      <button type="submit" class="button btn-new">Terminar venta</button>
      <a href="./cancelarVenta.php" class="button btn-delete">Cancelar venta</a>
    </form>
  </div>
</body>

</html>