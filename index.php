<?php
include_once "base_de_datos.php";
$sentencia = $base_de_datos->query("SELECT * FROM productos;");
$productos = $sentencia->fetchAll(PDO::FETCH_OBJ);
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
    <h1 class="title">Productos</h1>
    <div>
      <a class="button btn-new" href="./formulario.php">Nuevo <i class="fa fa-plus"></i></a>
    </div>
    <br>
    <table class="table">
      <thead class="table-head">
        <tr>
          <th>ID</th>
          <th>Código</th>
          <th>Descripción</th>
          <th>Precio de compra</th>
          <th>Precio de venta</th>
          <th>Existencia</th>
          <th>Editar</th>
          <th>Eliminar</th>
        </tr>
      </thead>
      <tbody class="table-body">
        <?php foreach ($productos as $producto) { ?>
          <tr>
            <td><?php echo $producto->id ?></td>
            <td><?php echo $producto->codigo ?></td>
            <td><?php echo $producto->descripcion ?></td>
            <td><?php echo $producto->precioCompra ?></td>
            <td><?php echo $producto->precioVenta ?></td>
            <td><?php echo $producto->existencia ?></td>
            <td><a class="button btn-edit" href="<?php echo "editar.php?id=" . $producto->id ?>"><i class="fa fa-edit"></i></a></td>
            <td><a class="button btn-delete" href="<?php echo "eliminar.php?id=" . $producto->id ?>"><i class="fa fa-trash"></i></a></td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</body>

</html>