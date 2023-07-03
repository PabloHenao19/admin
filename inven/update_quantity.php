<?php
require 'database.php';
require 'inventory_functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $productId = $_POST['product_id'];
  $quantity = $_POST['quantity'];
  $price = $_POST['price'];

  if (updateQuantity($productId, $quantity, $price)) {
    echo 'Cantidad y precio actualizados exitosamente.';
  } else {
    echo 'Error al actualizar la cantidad y el precio.';
  }
}
?>

<!-- Aquí va el formulario HTML para actualizar la cantidad y el precio de un producto -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Actualizar Cantidad y Precio</title>
</head>
<body>
  <h1>Actualizar Cantidad y Precio</h1>
  <form action="update_quantity.php" method="POST">
    <label for="product_id">ID del producto:</label>
    <input type="number" name="product_id" id="product_id" required>

    <label for="quantity">Nueva cantidad:</label>
    <input type="number" name="quantity" id="quantity" required>

    <label for="price">Nuevo precio:</label>
    <input type="number" name="price" id="price" required>

    <button type="submit">Actualizar</button>
  </form>

  <!--Boton para volver a la página anterior -->
  <button onclick="goBack()">Volver</button>

<script>
function goBack() {
  history.back();
}
</script>
</body>
</html>
