<section class="col-md-6 mt-4">
    <form action="">
        <div class="delivery-div">
            <h2 class="mt-4 mb-4">OPCIONES DE ENTREGA</h2>
        </div>
        <div class="d-flex justify-content-between  mb-4">
            <input type="hidden" name="delivery" value="<?= $_GET['delivery'] == 'true' ? 'true' : 'false' ?>">
            <a href="?controller=order&action=getCheckout&delivery=false"
                class="delivery-option<?= $_GET['delivery'] == 'false' ? '-active' : '' ?> p-3">
                <p class="mb-2 p-link">Recoger en la tienda</p>
                <div class="d-flex gap-3 align-items-center">
                    <p class="w-75 p-link">Deberás recoger tu pedido en la tienda a la hora establecida</p>
                    <p class="p-link"><strong>GRATIS</strong></p>
                </div>
            </a>
            <a href="?controller=order&action=getCheckout&delivery=true"
                class="delivery-option<?= $_GET['delivery'] == 'true' ? '-active' : '' ?> p-3">
                <p class="mb-2 p-link">Entrega a domicilio</p>
                <div class="d-flex gap-3 align-items-center">
                    <p class="p-link w-75">El repartidor recogerá tu pedido y te lo repartirá en tu dirección</p>
                    <p class="p-link"><strong>3,50€</strong></p>
                </div>
            </a>

        </div>
        <div class="delivery-div">
            <h2 class="mt-4 mb-4">DETALLES DE PAGO</h2>
        </div>
        <div class=" justify-content-between">
            <label class="p-2 mb-3 w-100 d-flex justify-content-between payment-option p-1">
                <div class="d-flex gap-4 align-items-center"><input class="ms-1 circle-checkbox" type="radio"
                        name="cash-paymeny">
                    <p class="p-1 p-link">Pago en efectivo</p>
                </div>
                <div class="d-flex align-items-center">
                    <img class="payment-icons" src="/drburger.com/public/images/euro.webp" alt="">
                </div>
            </label>
            <label class="p-2 mb-3 w-100 d-flex justify-content-between payment-option p-1">
                <div class="d-flex gap-4 align-items-center"><input class="ms-1 circle-checkbox" type="radio"
                        name="cash-paymeny">
                    <p class="p-1 p-link">Trajeta bancaria</p>
                </div>
                <div class="d-flex align-items-center">
                    <img class="payment-icons" src="/drburger.com/public/images/visa.webp" alt="visa">

                    <img class="payment-icons l-icon" src="/drburger.com/public/images/mastercard.webp" alt="mastercad">

                    <img class="payment-icons l-icon" src="/drburger.com/public/images/maestro.webp" alt="maestro">

                    <img class="payment-icons" src="/drburger.com/public/images/american-express.webp"
                        alt="american express">
                </div>
            </label> <label class="p-2 mb-3 w-100 d-flex justify-content-between payment-option p-1">
                <div class="d-flex gap-4 align-items-center"><input class="ms-1 circle-checkbox" type="radio"
                        name="cash-paymeny">
                    <p class="p-1 p-link">PayPal</p>
                </div>
                <div class="d-flex align-items-center">
                    <img class="payment-icons" src="/drburger.com/public/images/paypal.webp" alt="">
                </div>
            </label>

        </div>
    </form>
</section>