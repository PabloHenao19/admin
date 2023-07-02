<?php
require 'database.php';
require 'inventory_functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  if (isset($_GET['product_id'])) {
    $productId = $_GET['product_id'];

    if (deleteProduct($productId)) {
      echo 'Producto eliminado exitosamente.';
    } else {
      echo 'Error al eliminar el producto.';
    }
  }
}

$stmt = $conn->query('SELECT id, product_name FROM inventory');
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Eliminar Producto</title>
</head>
<body>
  <h1>Eliminar Producto</h1>

   <button onclick="goBack()">Volver</button>

<script>
function goBack() {
  history.back();
}
</script>

  <ul>
    <?php foreach ($products as $product): ?>
      <li><?php echo $product['product_name']; ?>
        <a href="delete_product.php?product_id=<?php echo $product['id']; ?>">Eliminar</a>
      </li>
    <?php endforeach; ?>
  </ul>
</body>
</html>

