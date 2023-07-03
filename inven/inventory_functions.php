<?php


function addProduct($productName, $quantity, $price, $imageURL, $category) {
  // Conexión a la base de datos
  $conn = connectToDatabase();

  // Preparar la consulta SQL
  $query = "INSERT INTO inventory (product_name, quantity, price, image_url, category) VALUES (:productName, :quantity, :price, :imageURL, :category)";
  $statement = $conn->prepare($query);

  // Asignar los valores de los parámetros y ejecutar la consulta
  $statement->bindValue(':productName', $productName);
  $statement->bindValue(':quantity', $quantity);
  $statement->bindValue(':price', $price);
  $statement->bindValue(':imageURL', $imageURL);
  $statement->bindValue(':category', $category);
  $result = $statement->execute();

  // Cerrar la conexión y liberar recursos
  $conn = null;

  // Devolver true si la inserción fue exitosa, o false en caso contrario
  return $result;
}




function getProducts($category = null) {
  $conn = connectToDatabase(); // Obtiene la conexión a la base de datos

  try {
    if ($category) {
      $stmt = $conn->prepare('SELECT product_name, quantity, price, image_url FROM inventory WHERE category = :category');
      $stmt->bindParam(':category', $category, PDO::PARAM_STR);
    } else {
      $stmt = $conn->query('SELECT product_name, quantity, price, image_url FROM inventory');
    }

    $stmt->execute();
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $products;
  } catch(PDOException $e) {
    echo "Error al obtener los productos: " . $e->getMessage();
    return null;
  }
}


function updateQuantity($productId, $quantity, $price) {
  $conn = connectToDatabase();
  
  // Preparar la consulta SQL para actualizar la cantidad y el precio de un producto en la tabla de inventario
  $sql = "UPDATE inventory SET quantity = :quantity, price = :price WHERE id = :id";
  $stmt = $conn->prepare($sql);
  
  // Asociar los parámetros de la consulta SQL con los valores recibidos como argumentos
  $stmt->bindParam(':quantity', $quantity);
  $stmt->bindParam(':price', $price);
  $stmt->bindParam(':id', $productId);
  
  // Ejecutar la consulta SQL y devolver el resultado de la ejecución
  return $stmt->execute();
}


function deleteProduct($productId) {
  global $conn;
  
  // Preparar la consulta SQL para eliminar un producto de la tabla de inventario
  $sql = "DELETE FROM inventory WHERE id = :id";
  $stmt = $conn->prepare($sql);
  
  // Asociar el parámetro de la consulta SQL con el valor recibido como argumento
  $stmt->bindParam(':id', $productId);
  
  // Ejecutar la consulta SQL y devolver el resultado de la ejecución
  return $stmt->execute();
}


?>
