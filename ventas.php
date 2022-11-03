<?php
include_once "base_de_datos.php";
$sentencia = $base_de_datos->query("SELECT ventas.total, ventas.fecha, ventas.id, GROUP_CONCAT(	productos.codigo, '..',  productos.descripcion, '..', productos_vendidos.cantidad SEPARATOR '__') AS productos FROM ventas INNER JOIN productos_vendidos ON productos_vendidos.id_venta = ventas.id INNER JOIN productos ON productos.id = productos_vendidos.id_producto GROUP BY ventas.id ORDER BY ventas.id;");
$ventas = $sentencia->fetchAll(PDO::FETCH_OBJ);
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

    <h1 class="title">Ventas</h1>
    <div>
      <a class="button btn-new" href="./vender.php">Nueva <i class="fa fa-plus"></i></a>
    </div>
    <br>
    <table class="table">
      <thead class="table-head">
        <tr>
          <th>Número</th>
          <th>Fecha</th>
          <th>Productos vendidos</th>
          <th>Total</th>
          <th>Ticket</th>
          <th>Eliminar</th>
        </tr>
      </thead>
      <tbody class="table-body">
        <?php foreach ($ventas as $venta) { ?>
          <tr>
            <td><?php echo $venta->id ?></td>
            <td><?php echo $venta->fecha ?></td>
            <td>
              <table class="table">
                <thead class="table-head">
                  <tr>
                    <th>Código</th>
                    <th>Descripción</th>
                    <th>Cantidad</th>
                  </tr>
                </thead>
                <tbody class="table-body">
                  <?php foreach (explode("__", $venta->productos) as $productosConcatenados) {
                    $producto = explode("..", $productosConcatenados)
                  ?>
                    <tr>
                      <td><?php echo $producto[0] ?></td>
                      <td><?php echo $producto[1] ?></td>
                      <td><?php echo $producto[2] ?></td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </td>
            <td><?php echo $venta->total ?></td>
            <td><a class="button btn-edit" href="<?php echo "imprimirTicket.php?id=" . $venta->id ?>"><i class="fa fa-print"></i></a></td>
            <td><a class="button btn-delete" href="<?php echo "eliminarVenta.php?id=" . $venta->id ?>"><i class="fa fa-trash"></i></a></td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</body>

</html>