<?php
// Array de productos con su información
$productos = array(
  array(
    "imagen" => "https://media.istockphoto.com/id/640199310/es/foto/mujer-enviando-mensajes-de-texto-al-aire-libre.jpg?s=612x612&w=0&k=20&c=oyiwbzMRO6rLkC52gAgQksdm76LCAW-JpC2ODsmndf4=",
    "nombre" => "BUZO GRIS",
    "precio" => "$300.000"
  ),
  array(
    "imagen" => "https://media.istockphoto.com/id/1252385356/es/foto/disparo-de-belleza-con-modelo-brunete-estudio-editorial-gris-bakground.jpg?s=612x612&w=0&k=20&c=IgwJ5xayzVNVr6x4MMVac7-O-gJtMpnKTCY1KfD0Di4=",
    "nombre" => "BLUSA AZUL",
    "precio" => "$120.000"
  ),
  array(
    "imagen" => "https://images.unsplash.com/photo-1568663521381-33b7c467fda0?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=422&q=80",
    "nombre" => "CONJUNTO NEGRO",
    "precio" => "$160.000"
  ),
  array(
    "imagen" => "https://images.unsplash.com/photo-1512005286309-e5b890ca36b6?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1032&q=80",
    "nombre" => "BRASIER GRIS",
    "precio" => "$80.000"
  ),
  array(
    "imagen" => "https://media.istockphoto.com/id/498139098/es/foto/chica-con-una-bolsa-espera-de-salida.jpg?s=612x612&w=0&k=20&c=FYuST-k8Qvt8uBxdMI_HwnvscpsqpApLl7PPLDDgCzo=",
    "nombre" => "BUZO BEIGE",
    "precio" => "$290.000"
  ),
  array(
    "imagen" => "https://plus.unsplash.com/premium_photo-1664373232909-32af52b7cacd?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=374&q=80",
    "nombre" => "CAMISA AZUL",
    "precio" => "$100.000"
  ),
  array(
    "imagen" => "https://media.istockphoto.com/id/640199310/es/foto/mujer-enviando-mensajes-de-texto-al-aire-libre.jpg?s=612x612&w=0&k=20&c=oyiwbzMRO6rLkC52gAgQksdm76LCAW-JpC2ODsmndf4=",
    "nombre" => "VESTIDO ROJO",
    "precio" => "$240.000"
  )
);

// Función para mostrar los productos en el carrito
function mostrarProductos() {
  global $productos;

  foreach ($productos as $producto) {
    echo '<div class="producto">';
    echo '<img src="' . $producto["imagen"] . '" alt="' . $producto["nombre"] . '">';
    echo '<h3>' . $producto["nombre"] . '</h3>';
    echo '<p>' . $producto["precio"] . '</p>';
    echo '<button class="boton-agregar" onclick="agregarCarrito(\'' . $producto["nombre"] . '\')">Agregar al carrito</button>';
    echo '</div>';
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Tienda de ropa</title>
  <link rel="stylesheet" href="style2.css">
    <script src="https://kit.fontawesome.com/17552d8682.js" crossorigin="anonymous"></script>
</head>
<body>
  <h1>Tienda de ropa</h1>
  
  <div id="carrito">
    <h2>Carrito de compras</h2>
    <ul id="lista-carrito"></ul>
    <button id="boton-comprar" onclick="realizarCompra()">Realizar compra</button>
  </div>
  
  <div id="productos">
    <h2>Productos</h2>
    <?php mostrarProductos(); ?>
  </div>
</body>
</html>
