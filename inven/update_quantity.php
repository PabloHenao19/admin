<?php
require 'database.php';
require 'inventory_functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $productId = $_POST['product_id'];
  $quantity = $_POST['quantity'];

  if (updateQuantity($productId, $quantity)) {
    echo 'Cantidad actualizada exitosamente.';
  } else {
    echo 'Error al actualizar la cantidad.';
  }
}
?>

<!-- Aquí va el formulario HTML para actualizar la cantidad de un producto -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Actualizar Cantidad</title>
</head>
<body>
  <h1>Actualizar Cantidad</h1>
  <form action="update_quantity.php" method="POST">
    <label for="product_id">ID del producto:</label>
    <input type="number" name="product_id" id="product_id" required>

    <label for="quantity">Nueva cantidad:</label>
    <input type="number" name="quantity" id="quantity" required>

    <button type="submit">Actualizar</button>

  </form>

  <!--Boton para volver a la pagina anteriror -->
  <button onclick="goBack()">Volver</button>

<script>
function goBack() {
  history.back();
}
</script>
</body>
</html>
