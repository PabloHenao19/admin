<?php
// Con el método require se llama al archivo database.php
require 'database.php';

// Validación del formulario
if (!empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['confirm_password']) && !empty($_POST['nombre']) && !empty($_POST['apellido'])) {
  
  // Verificar si las contraseñas coinciden
  if ($_POST['password'] !== $_POST['confirm_password']) {
    echo "<script>alert('Las contraseñas no coinciden');</script>";
  } else {
    // Validar nombre y apellido (caracteres especiales no permitidos)
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];

    if (!preg_match("/^[a-zA-Z ]*$/", $nombre) || !preg_match("/^[a-zA-Z ]*$/", $apellido)) {
      echo "<script>alert('Los caracteres especiales no están permitidos en el nombre y apellido');</script>";
    } else {
      // Verificar si el correo electrónico ya existe en la base de datos
      $existingEmail = $_POST['email'];
      $sql = "SELECT * FROM users WHERE email = :email";
      $stmt = $conn->prepare($sql);
      $stmt->bindParam(':email', $existingEmail);
      $stmt->execute();

      // Si la consulta devuelve algún resultado (es decir, si rowCount() es mayor que 0),
      // se establece un mensaje de error indicando que el correo electrónico ya está registrado.
      if ($stmt->rowCount() > 0) {
        echo "<script>alert('El correo electrónico ya está registrado');</script>";
      } else {
        // Continuar con la inserción en la base de datos
        $sql = "INSERT INTO users (email, password, nombre, apellido) VALUES (:email, :password, :nombre, :apellido)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $_POST['email']);

        // password_hash crea una contraseña encriptada y segura
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':apellido', $apellido);

        if ($stmt->execute()) {
          header("Location: index.php");
          exit();
        } else {
          $message = 'ERROR DE CONEXIÓN';
          echo "<script>alert('ERROR DE CONEXIÓN');</script>";
        }
      }
    }
  }
} else {
  $message = 'Por favor, completa todos los campos';
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SignUp</title>
  <link rel="stylesheet" href="style2.css">
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
  <!-- Esta línea de código verifica si la variable $message no está vacía. Si $message contiene un mensaje 
  (es decir, no está vacío), se ejecuta el bloque de código que sigue a continuación.-->
  <main>
  <?php if(!empty($message)): ?>
  <p> <?= $message ?></p>
<?php endif; ?>

  <h1>SignUp</h1>
  <span>or <a href="login.php">Login</a></span>
    
  <form action="signup.php" method="post">
  <input type="text" name="nombre" placeholder="Nombre" required>
    <input type="text" name="apellido" placeholder="Apellido" required>
    <input type="text" name="email" placeholder="Ingresar correo" required>
    <input type="password" name="password" placeholder="Ingresar contraseña" required>
    <input type="password" name="confirm_password" placeholder="Confirmar tu contraseña" required>
    
    
    
    <input type="submit" value="Send">
  </form>
  </main>
</body>
</html>