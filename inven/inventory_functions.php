<?php


function addProduct($productName, $quantity, $price, $imageURL) {
  // Conexión a la base de datos
  $conn = connectToDatabase();

  // Preparar la consulta SQL
  $query = "INSERT INTO inventory (product_name, quantity, price, image_url) VALUES (:productName, :quantity, :price, :imageURL)";
  $statement = $conn->prepare($query);

  // Asignar los valores de los parámetros y ejecutar la consulta
  $statement->bindValue(':productName', $productName);
  $statement->bindValue(':quantity', $quantity);
  $statement->bindValue(':price', $price);
  $statement->bindValue(':imageURL', $imageURL);
  $result = $statement->execute();

  // Cerrar la conexión y liberar recursos
  $conn = null;

  // Devolver true si la inserción fue exitosa, o false en caso contrario
  return $result;
}


function getProducts() {
  // Conexión a la base de datos
  $conn = connectToDatabase();

  // Consulta SQL para obtener los productos de la tabla de inventario
  $query = "SELECT * FROM inventory";
  $statement = $conn->query($query);

  // Verificar si se encontraron resultados
  if ($statement !== false) {
    $products = array();

    // Recorrer los resultados y almacenarlos en un array
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
      $products[] = $row;
    }

    // Cerrar el cursor
    $statement->closeCursor();

    // Devolver el array de productos
    return $products;
  } else {
    // Si no se encontraron resultados, devolver un array vacío
    return array();
  }
}


function updateQuantity($productId, $quantity) {
  global $conn;
  
  // Preparar la consulta SQL para actualizar la cantidad de un producto en la tabla de inventario
  $sql = "UPDATE inventory SET quantity = :quantity WHERE id = :id";
  $stmt = $conn->prepare($sql);
  
  // Asociar los parámetros de la consulta SQL con los valores recibidos como argumentos
  $stmt->bindParam(':quantity', $quantity);
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
