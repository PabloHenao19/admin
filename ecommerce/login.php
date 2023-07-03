<?php
// función para iniciar o reanudar una sesión existente.
session_start();

// Comprobar si ya hay una sesión iniciada
if (isset($_SESSION['user_id'])) {
  header("Location: index.php");
  exit();
}
// llamar a la base de datos
require 'database.php';

// Comprobar si se han enviado los campos de correo electrónico y contraseña a través del formulario de inicio de sesión
if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $records = $conn->prepare('SELECT id, email, password FROM users WHERE email = :email');
    $records->bindParam(':email', $_POST['email']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $message = '';

    // Verificar si se encontraron resultados y si la contraseña coincide
    if ($results !== false && password_verify($_POST['password'], $results['password'])) {
        $_SESSION['user_id'] = $results['id'];
        header("Location: index.php");
        exit(); 
        
    } else {
        //integración con js para generar la alerta en cual caso erroneo
        $message = 'Correo o Contraseña incorrectos';
        echo "<script>alert('Correo o Contraseña incorrectos');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
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
                <li class="nav-menu-item"><a href="Project.html" class="nav-menu-link nav-like">Inicio</a></li>
                <li class="nav-menu-item"><a href="index.php" class="nav-menu-link nav-like">Cuenta</a></li>
                <li class="nav-menu-item"><a href="Envio.html" class="nav-menu-link nav-like">Envio</a></li>
                <li class="nav-menu-item"><a href="Contacto.html" class="nav-menu-link nav-like">Contacto</a></li>
          </ul>
            </nav> 
            
      </header>

<main> 
<?php if(!empty($message)): ?>
    <script>alert('Correo o Contraseña incorrectos');</script>
<?php endif; ?>

<h1>LOGIN</h1>
<span>or <a href="signup.php">SignUp</a></span>
    <form action="login.php" method="post">
        <input type="text" name="email" placeholder="Ingresar correo">
        <input type="password" name="password" placeholder="Ingresar contraseña">
        <input type="submit" value="Send">
    </form>
    <a href="ForgotPassword.php">¿Olvidaste tu contraseña?</a>
</main>
</body>
</html>