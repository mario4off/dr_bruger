<section class="col-md-6 mt-4">
    <form id="form-checkout" action="?controller=order&action=makeOrder&delivery=<?= $_SESSION['delivery'] ?>"
        method="POST">
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
                        name="payment-option" value="Efectivo" required id="input-cash">
                    <p class="p-1 p-link">Pago en efectivo</p>
                </div>
                <div class="d-flex align-items-center">
                    <img class="payment-icons" src="/drburger.com/public/images/euro.webp" alt="">
                </div>
            </label>
            <label class="p-2 mb-3 w-100 d-flex justify-content-between payment-option p-1" data-bs-toggle="collapse"
                data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample"
                id="collapse-Element">
                <div class="d-flex gap-4 align-items-center">
                    <input id="input-card" class="ms-1 circle-checkbox" type="radio" name="payment-option"
                        value="Tarjeta">
                    <p class="p-1 p-link">Tarjeta bancaria</p>
                </div>
                <div class="d-flex align-items-center">
                    <img class="payment-icons" src="/drburger.com/public/images/visa.webp" alt="visa">

                    <img class="payment-icons l-icon" src="/drburger.com/public/images/mastercard.webp" alt="mastercad">

                    <img class="payment-icons l-icon" src="/drburger.com/public/images/maestro.webp" alt="maestro">

                    <img class="payment-icons" src="/drburger.com/public/images/american-express.webp"
                        alt="american express">
                </div>

            </label>
            <div class="collapse" id="collapseExample">
                <div class="mb-3 toggle-payment p-3">
                    <div class="d-flex flex-column">
                        <label for="card-num">Número de tarjeta</label><input id="event-num" type="text" name="card-num"
                            pattern="\d{16}" placeholder="1234 5678 9012 3456" maxlength="16">
                    </div>
                    <div class="d-flex justify-content-between w-75 mt-2 mb-2">
                        <div class="d-flex flex-column">
                            <label for="expiration">Fecha de expiración</label><input id="event-expiration" type="text"
                                pattern="(0[1-9]|1[0-2])\/([0-9]{2})" placeholder="MM/AA" name="expiration"
                                maxlength="5">
                        </div>
                        <div class="d-flex flex-column">
                            <label for="security-code">Código de seguridad</label><input id="event-cvv"
                                placeholder="3 dígitos" type="text" name="cvv" minlength="3" maxlength="4">
                        </div>
                    </div>
                    <div class="d-flex flex-column">
                        <label for="card-num">Nombre de la tarjeta</label><input id="event-name" type="text"
                            placeholder="Juan Pérez" name="cardholder">
                    </div>
                </div>
            </div> <label class="p-2 mb-3 w-100 d-flex justify-content-between payment-option p-1">
                <div class="d-flex gap-4 align-items-center"><input class="ms-1 circle-checkbox" type="radio" required
                        name="payment-option" value="PayPal" id="input-paypal">
                    <p class=" p-1 p-link">PayPal</p>
                </div>
                <div class="d-flex align-items-center">
                    <img class="payment-icons" src="/drburger.com/public/images/paypal.webp" alt="">
                </div>
            </label>
        </div>
        <div class="delivery-div">
            <h2 class="mt-4 mb-4">INFORMACIÓN DEL PEDIDO</h2>
        </div>
        <div class="d-flex flex-column mb-4">
            <div class="d-flex justify-content-between w-100 mb-3">
                <div class="d-flex flex-column"><label class="mb-1" for="discount-code">¿Tienes algún código de
                        descuento?</label><input class="p-1" type="text" name="discount-code"
                        placeholder="Intoduce el código">
                </div>
                <div class="d-flex align-items-end"> <a class="snd-btn-1"
                        href="?controller=order&action=applyPromo">APLICAR</a></div>
            </div>
            <div class="d-flex justify-content-between w-100">
                <div class="d-flex flex-column w-100"><label class="mb-1" for="allergies">¿Tienes alguna alergia
                        alimenticia o quieres hacernos algún comentario sobre tu pedido?</label><textarea class="p-1"
                        name="allergies" class="w-100"
                        placeholder="Escribe aquí sobre tus alergias o lo que quieras comentar"></textarea>
                </div>

            </div>
            <p class="mt-4">Al realizar este pedido acepto todos los <a
                    class="text-decoration-underline text-reset href="">Términos y Condiciones</a></p>
            <input class=" rm-input-style input-submit mt-4" type="submit" value="REALIZAR PEDIDO Y PAGAR">

        </div>
    </form>
</section>