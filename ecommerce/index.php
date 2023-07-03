<?php
session_start();
require 'database.php';

if (isset($_SESSION['user_id'])) {
  $records = $conn->prepare('SELECT id, email, nombre, password FROM users WHERE id = :id');
  $records->bindParam(':id', $_SESSION['user_id']);
  $records->execute();
  $results = $records->fetch(PDO::FETCH_ASSOC);

  $user = null;

  if (count($results) > 0) {
    $user = $results;
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Welcome to Your App</title>
  <link rel="stylesheet" href="style1.css">

</head>
<body>
<header class="header">
        <nav class="nav">
            <a href="general.php" class="logo nav-like">BEAR FASHION</a>  
    
           
              
            
              <button class="nav-toggle" aria-label="abrir menu"> <i class="fa-solid fa-bars"> </i> </button>
    
              
    
    
            <ul class="nav-menu nav-menu_visible">

              <!--Este es el principio del carrito
              <div class="container-icon">
                <div class="container-cart-icon">
                    <button class="cart-shopping"> <i class="fa-solid fa-cart-shopping"></i> </button>
                <div class="count-product">
                    <span id="contador-productos">0</span>
                </div>
                </div>
                <div class="container-cart-product hidden-cart">
                    <div class="row-product">
                        <div class="cart-product">
                            <div class="info-cart-product">
                                <span class="cantidad-producto-carrito"></span>
                                <p class="titulo-producto-carrito"></p>
                                <span class="precio-producto-carrito"></span>
                                <button class="icon-close"><i class=" fa-solid fa-xmark"></i></button>
        
                            </div>
                            
                        </div>
                    </div>
                    <div class="cart-total hidden"> 
                        <h3>TOTAL</h3>
                        <SPAN class="total-pagar">$0</SPAN>
    
                    </div>
                    <p class="cart-empty"></p>
                </div>
            </div>
            Esto es el final del carrito-->
                <li class="nav-menu-item"><a href="general.php" class="nav-menu-link nav-like">Inicio</a></li>
                <li class="nav-menu-item"><a href="login.php" class="nav-menu-link nav-like">Cuenta</a></li>
                <li class="nav-menu-item"><a href="envio.php" class="nav-menu-link nav-like">Envio</a></li>
                <li class="nav-menu-item"><a href="contacto.php" class="nav-menu-link nav-like">Contacto</a></li>
          </ul>
            </nav> 
            
      </header>
      <main> 
<?php if(!empty($user)): ?>
  <h1>BIENVENIDO, <?= $user['nombre']; ?></h1>
  <p>Has ingresado correctamente.</p>
  <a href="logout.php">Logout</a>
<?php else: ?>
  <h1>Please Login or Sign Up</h1>
  <a href="login.php">Login</a> or
  <a href="signup.php">Sign Up</a>
  

<?php endif; ?>

</main>
</body>
</html>