<div class="container">
    <h1 class="ms-4 pt-3 mb-3">FINALIZAR COMPRA</h1>
    <div class="d-none-block d-md-flex justify-content-center gap-5 mb-4">


        <?php if (isset($_SESSION['name'])) {
            include_once('app/views/partials/data_checkout.php');
        } else {
            include_once('app/views/partials/login.php');
        } ?>
        <section class="col-5 cart p-3 pt-0 pb-1  mt-4 mb-4 checkout-box d-flex flex-column justify-content-between">
            <?php if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
                include_once('app/views/partials/cart_section.php');
            } else {
                ?>
                <div class="h-100 d-flex align-items-center flex-column justify-content-center">
                    <h2 class="mb-2 mt-2 fs-2">EL CARRITO ESTÁ VACÍO</h2>

                    <i class="fa-solid fa-burger burger-icon mb-3"></i>
                    <p class="mb-3">Aún estás a tiempo de añadir alguno de tus productos favoritos</p>
                    <a class="snd-btn-1 mb-3" href="?controller=product&action=showMenu">VER PRODUCTOS</a>
                </div>
                <?php

            } ?>
        </section>
    </div>

</div>