<?php

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



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medio_de_pago</title>
    <script src="https://sdk.mercadopago.com/js/v2"></script>


</head>
<body>

<div class="checkout-btn"></div>

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

    
</body>
</html>