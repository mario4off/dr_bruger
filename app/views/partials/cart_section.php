<?php
$totalAmount = 0;
foreach ($_SESSION['cart'] as $product) {
    ?>
    <!-- Se realiza una extracción de los datos de la variable de sesión que contiene los datos del carrito y se muestran 
 pantalla los productos con todos sus datos-->
    <article class="d-flex gap-3 checkout-border pb-3 pt-3">
        <img class="w-25 p-3 img-product" src="public/images/<?= $product->getMain_photo() ?>">
        <div class=" w-75  d-flex flex-column justify-content-between">
            <div class="d-flex justify-content-between">
                <p class="p-items-checkout "><?= strtoupper($product->getProduct_name()) ?></p>
                <p class="p-items-checkout">
                    <?= number_format($product->getBase_price() * $product->getQuantity(), 2, ',') ?>€
                </p>
            </div>
            <div class="d-flex justify-content-between h-50 align-items-center">
                <div class="d-flex gap-4">
                    <p class="snd-p-items-checkout">CANTIDAD: <?= $product->getQuantity() ?></p>
                    <!-- Aquí se insertan los botones que gestionan la lógica para reducir las cantidades del producto -->
                    <div><a class="add-quantity-btn"
                            href="?controller=order&action=addUnit&productId=<?= $product->getProduct_id() ?>"><i
                                class="fa-solid fa-plus"></i></a><a class="rm-quantity-btn"
                            href="?controller=order&action=removeUnit&productId=<?= $product->getProduct_id() ?>"><i
                                class="fa-solid fa-minus"></i></a></div>
                    </a>
                    <!-- Aquí el link para eliminar directamente un producto del carrito -->
                </div> <a class="rm-link-checkout"
                    href="?controller=order&action=removeItem&productId=<?= $product->getProduct_id() ?>">Eliminar</a>
            </div>
        </div>
    </article>
    <?php
    // Aquí obtenemos el calculadop acumulado con las cantidades del total del carrito
    $totalAmount += $product->getBase_price() * $product->getQuantity();
    $_SESSION['totalAmount'] = $totalAmount;
} ?>
<div class="checkout-border pt-2 pb-2">
    <div class="d-flex w-100 justify-content-between mb-2">
        <p class="snd-p-items-checkout">SUBTOTAL</p>
        <p><?= number_format($totalAmount, '2', ',') ?>€</p>
    </div>
    <div class="d-flex w-100 justify-content-between">
        <p class="snd-p-items-checkout">ENVÍO</p>
        <p><?= isset($_GET['delivery']) && $_GET['delivery'] == 'true' ? '3,50€' : '0,00€' ?></p>
    </div>
    <!-- Aquí si hay algún descuento activo permite quitar el código así como ver el código
     aplicado y el descuento en números a través de la sesión -->
    <?php if (isset($_SESSION['discount'])) { ?>
        <div class="d-flex w-100 mt-2 justify-content-between">
            <p class="snd-p-items-checkout">DESCUENTO</p>
            <p>-<?= number_format($_SESSION['discount']['amount'], 2, ',') ?>€</p>
        </div>
        <div class="d-flex justify-content-between mt-1">
            <p><?= $_SESSION['discount']['code'] ?></p> <a class="rm-link-checkout"
                href="?controller=order&action=removeDiscount">Quitar descuento</a>
        </div>
        <?php $totalAmount -= $_SESSION['discount']['amount'];
    } ?>
    <!-- Este formulario se ubica aquí para no dar confilcto con el otro formulario, y envía con un input oculto el importe
     del pedido para poder calcular de este modo el descuento en caso de introducir algún código válido -->
    <form action="?controller=order&action=applyPromo" method="POST"
        class="d-flex justify-content-between w-100 mb-2 mt-3">
        <div class="d-flex flex-column"><label class="mb-1 fs-6" hidden for="discount-code">¿Tienes algún código de
                descuento?</label><input class="p-1" type="text" name="discount-code" placeholder="Código de descuento">
            <input type="number" name="orderAmount" hidden value="<?= $totalAmount ?>">
        </div>
        <div class="d-flex align-items-center"> <input type="submit" class="snd-btn-1"
                href="?controller=order&action=applyPromo" value="APLICAR">
        </div>

    </form>
    <!-- Aqui se informan todos los avisos relacionados con la aplicación del descuento -->
    <?php
    if (isset($_GET['warning']) && $_GET['warning'] == 'invalid_code') {

        ?>
        <div class="warning p-1 mb-2 w-100 text-center">
            <p class="m-2">EL CÓDIGO DE DESCUENTO NO EXISTE</p>
        </div>

        <?php
    } elseif (isset($_GET['warning']) && $_GET['warning'] == 'code_already_applied') {
        ?>
        <div class="warning p-1 mb-2 w-100 text-center">
            <p class="m-2">EL CÓDIGO YA HA SIDO USADO</p>
        </div>

    <?php } elseif (isset($_GET['warning']) && $_GET['warning'] == 'promo_expired') {
        ?>
        <div class="warning p-1 mb-2 w-100 text-center">
            <p class="m-2">LA PROMOCIÓN YA HA EXPIRADO</p>
        </div>

    <?php } elseif (isset($_GET['warning']) && $_GET['warning'] == 'login_needed') {
        ?>
        <div class="warning p-1 mb-2 w-100 text-center">
            <p class="m-2">INICIA SESIÓN PARA APLICAR EL CÓDIGO</p>
        </div>

    <?php } ?>
</div>

<div class="pt-3 pb-3 d-flex w-100 justify-content-between">
    <p class="p-items-checkout p-total-checkout ">TOTAL</p>
    <p class="p-items-checkout p-total-checkout ">
        <?php
        // Aquí finalmente mostramos el toal del pedido con costes de envío si los hubiera
        if (isset($_GET['delivery']) && $_GET['delivery'] == 'true') {
            $_SESSION['totalAmount'] = $totalAmount + 3.5;
        } else {
            $_SESSION['totalAmount'] = $totalAmount;
        }

        echo number_format($_SESSION['totalAmount'], 2, ',');
        ?>€
    </p>
</div>