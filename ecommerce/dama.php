<?php
require '../inven/database.php';
require '../inven/inventory_functions.php';
require 'vendor/autoload.php';


// SDK de Mercado Pago
require __DIR__ .  '/vendor/autoload.php';
// Agrega credenciales
MercadoPago\SDK::setAccessToken('TEST-772990494508429-070315-df7574daec06090d748c173581fce4aa-726901671');

// Crea un objeto de preferencia
$preference = new MercadoPago\Preference();

// Crea un ítem en la preferencia
$item = new MercadoPago\Item();
$item->title = 'Mi producto';
$item->quantity = 1;
$item->unit_price = 75; 


$preference->items = array($item);
$preference->save();


$productsDama = getProducts('dama');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style2.css">
    <script src="https://kit.fontawesome.com/17552d8682.js" crossorigin="anonymous"></script>
</head>

<body>
<header class="header">
          <nav class="nav">
              <a href="general.php" class="logo nav-like">BEAR_FASHION</a>  
      
                <div class="Buscar">
                  <input type="text" placeholder="Buscar">
                </div>
                
              
                <button class="nav-toggle" aria-label="abrir menu"> <i class="fa-solid fa-bars"> </i> </button>
      
                
      
      
              <ul class="nav-menu nav-menu_visible">

                <!--Este es el principio del carrito-->
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

                      <div class="checkout-btn"></div>

                      <script src="https://sdk.mercadopago.com/js/v2"></script>

<script>
    const mp = new MercadoPago('TEST-1cc34c47-f7e7-4cf0-b153-9f8210fc8706');

    mp.checkout({
        preference:{
            id: '<?php echo $preference->id; ?>'
        }, 
        render: {
            container: '.checkout-btn',
            label: 'pagar'
        }
    })


</script>


                  </div>
              </div>
              
              <!--Esto es el final del carrito-->
                  <li class="nav-menu-item"><a href="general.php" class="nav-menu-link nav-like">Inicio</a></li>
                  <li class="nav-menu-item"><a href="index.php" class="nav-menu-link nav-like">Cuenta</a></li>
                  
                  <li class="nav-menu-item"><a href="contacto.php" class="nav-menu-link nav-like">Contacto</a></li>
            </ul>
              </nav> 
              
        </header>

  <div class="video"> <video src="Imagen/video2.mp4" loop autoplay muted></video> </div>

  <div class="container-img">
  <?php if ($productsDama): ?>
  <?php foreach ($productsDama as $product): ?>
    <div class="items">
      <figure><img class="product-image" src="<?php echo $product['image_url']; ?>" alt="<?php echo $product['product_name']; ?>"></figure>
      <div class="info-product">
        <h2><?php echo $product['product_name']; ?></h2>
        <p><?php echo $product['price']; ?></p>
        <button class="btn-add-cart">Añadir al carrito</button>
      </div>
    </div>
  <?php endforeach; ?>
</div>
<?php else: ?>
  <p>No se encontraron productos.</p>
<?php endif; ?>




<script src="carrito.js"></script>
</body>
</html>
