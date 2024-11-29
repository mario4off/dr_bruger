<?php
$totalAmount = 0;
foreach ($_SESSION['cart'] as $product) {
    ?>

    <article class="d-flex gap-3 checkout-border pb-4 pt-4">
        <img class="w-25 p-3 img-product" src="/drburger.com/public/images/<?= $product->getMain_photo() ?>">
        <div class=" w-75  d-flex flex-column justify-content-between">
            <div class="d-flex justify-content-between">
                <p class="p-items-checkout "><?= strtoupper($product->getProduct_name()) ?></p>
                <p class="p-items-checkout">
                    <?= number_format($product->getBase_price() * $product->getQuantity(), 2, ',') ?>€
                </p>
            </div>
            <div class="d-flex justify-content-between h-50 align-items-center">
                <p class="snd-p-items-checkout">CANTIDAD: <?= $product->getQuantity() ?></p>
                <div><a class="add-quantity-btn"
                        href="?controller=order&action=addUnit&productId=<?= $product->getProduct_id() ?>"><i
                            class="fa-solid fa-plus"></i></a><a class="rm-quantity-btn"
                        href="?controller=order&action=removeUnit&productId=<?= $product->getProduct_id() ?>"><i
                            class="fa-solid fa-minus"></i></a></div>
                </a><a class="rm-link-checkout"
                    href="?controller=order&action=removeItem&productId=<?= $product->getProduct_id() ?>">Eliminar</a>
            </div>
        </div>
    </article>
    <?php
    $totalAmount += $product->getBase_price() * $product->getQuantity();
} ?>
<div class="checkout-border pt-2 pb-2">
    <div class="d-flex w-100 justify-content-between mb-2">
        <p class="snd-p-items-checkout">SUBTOTAL</p>
        <p>2,00€</p>
    </div>
    <div class="d-flex w-100 justify-content-between">
        <p class="snd-p-items-checkout">ENVÍO</p>
        <p>0,00€</p>
    </div>
</div>
<div class="pt-2 pb-3 d-flex w-100 justify-content-between">
    <p class="p-items-checkout p-total-checkout ">TOTAL</p>
    <p class="p-items-checkout p-total-checkout "><?= number_format($totalAmount, 2, ',') ?>€</p>
</div>