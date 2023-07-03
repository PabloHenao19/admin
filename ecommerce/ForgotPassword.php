<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/SMTP.php';

// Verificar si se ha enviado un formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Obtener el correo electrónico del formulario
  $email = $_POST['email'];

  // Verificar si el correo electrónico existe en la base de datos
  if (!empty($email)) {
    // Establecer la conexión con la base de datos
    $conn = new PDO("mysql:host=$server;dbname=php_login_database", 'root', '');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $query = $conn->prepare('SELECT id FROM users WHERE email = :email');
    $query->bindParam(':email', $email);
    $query->execute();
    $user = $query->fetch(PDO::FETCH_ASSOC);

    if ($user) {
      // Generar un token único y seguro
      $token = bin2hex(random_bytes(32));

      // Almacenar el token y su fecha de expiración en la base de datos
      $query = $conn->prepare('UPDATE users SET reset_token = :token, reset_token_expires = DATE_ADD(NOW(), INTERVAL 1 HOUR) WHERE id = :user_id');
      $query->bindParam(':token', $token);
      $query->bindParam(':user_id', $user['id']);
      $query->execute();

      // Construir el enlace para restablecer la contraseña
      $resetLink = "https://example.com/ResetPassword.php?token=$token";

      // Redireccionar a la página de restablecimiento de contraseña
      $_SESSION['reset_link'] = $resetLink;
      header('Location: ResetPassword.php');
      exit();
    } else {
      // Código a ejecutar si no se encontró ningún usuario con el correo electrónico proporcionado
      $_SESSION['error'] = 'No se encontró ningún usuario con el correo electrónico proporcionado.';
      header('Location: ForgotPassword.php');
      exit();
    }
  } else {
    // Código a ejecutar si no se proporcionó un correo electrónico válido
    $_SESSION['error'] = 'Por favor, proporciona un correo electrónico válido.';
    header('Location: ForgotPassword.php');
    exit();
  }
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Forgot Password</title>
  <link rel="stylesheet" href="style1.css">
</head>
<body>
<header class="header">
        <nav class="nav">
            <a href="Project.html" class="logo nav-like">BEAR FASHION</a>  
    
           
              
            
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
  <h1>Forgot Password</h1>
  <!-- Formulario para solicitar el correo electrónico -->
  <form method="POST" action="ForgotPassword.php">
    <label for="email">Correo electrónico:</label>
    <input type="email" name="email" required>
    <button type="submit">Enviar</button>
  </form>
  <a href="login.php">Login</a> 
  <?php
  if (isset($_SESSION['error'])) {
    echo '<p style="color: red;">' . $_SESSION['error'] . '</p>';
    unset($_SESSION['error']);
  }
  ?>
  </main>
</body>
</html>