<section class="col-md-6 mt-4">
    <!-- De nuevo gestión de error por si no hubiera conexión con la base de datos u otro -->
    <?php
    if (isset($_GET['error']) && $_GET['error'] == 'insert_order') {

        ?>
        <div class="error mb-4 w-100 text-center">
            <p class="m-2"><strong>NO SE HA PODIDO INTRODUCIR LOS DETALLES DEL PEDIDO</strong></p>
            <p class="m-2">Ha habido un error al introducir los detalles del pedido en el sistema. Por favor, vuelve a
                intentarlo más tarde.</p>
        </div>

        <?php
    } ?>
    <!-- Se envía un formulario por POST con los detalles del envío -->
    <form id="form-checkout" action="?controller=order&action=makeOrder&delivery=<?= $_GET['delivery'] ?>"
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
                    <img class="payment-icons" src="public/images/euro.webp" alt="Billete">
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
                    <img class="payment-icons" src="public/images/visa.webp" alt="visa">

                    <img class="payment-icons l-icon" src="public/images/mastercard.webp" alt="mastercad">

                    <img class="payment-icons l-icon" src="public/images/maestro.webp" alt="maestro">

                    <img class="payment-icons" src="public/images/american-express.webp" alt="american express">
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
                    <img class="payment-icons" src="public/images/paypal.webp" alt="Logo de paypal">
                </div>
            </label>
        </div>
        <div class="delivery-div">
            <h2 class="mt-4 mb-4">INFORMACIÓN DEL PEDIDO</h2>
        </div>
        <div class="d-flex flex-column mb-4">

            <div class="d-flex justify-content-between w-100">
                <div class="d-flex flex-column w-100"><label class="mb-1" for="allergies">¿Tienes alguna alergia
                        alimenticia o quieres hacernos algún comentario sobre tu pedido?</label><textarea class="p-1"
                        name="allergies" class="w-100"
                        placeholder="Escribe aquí sobre tus alergias o lo que quieras comentar"></textarea>
                </div>

            </div>
            <p class="mt-4">Al realizar este pedido acepto todos los <a
                    class="text-decoration-underline text-reset href="">Términos y Condiciones</a></p>
            <input class=" rm-input-style input-submit mt-4 mb-2" type="submit" value="REALIZAR PEDIDO Y PAGAR">

        </div>
    </form>

    <!-- Esto es interesante porque es la aplicación de la cookie. Lo que sucede aquí, es que si la cookie existe
     y tiene contenido, hará una sugerencia sobre la última categoría vista por el usuario y le recomendará los productos
     más vendidos de esta categoría -->
    <?php
    if (isset($_COOKIE['suggest']) && !empty($_COOKIE['suggest']) && ($_COOKIE['suggest']) != "a:0:{}") {

        ?>
        <div class="mt-4">
            <h2>TAMBIÉN TE PUEDE INTERESAR</h2>
            <div class="row"> <?php
            $suggestion = unserialize($_COOKIE['suggest']);

            foreach ($suggestion as $product) {
                ?>
                    <article class="card div-best-seller col-6 col-sm-6 col-md-3 justify-content-around">
                        <a class="img-product"
                            href="?controller=product&action=addToCart&productId=<?= $product['product_id'] ?>"><img
                                class="card-img-top pb-5 ps-3 pe-3" src="public/images/<?= $product['main_photo'] ?>"
                                alt="Imagen de producto sugerido"></a>
                        <div class="card-body ps-0 pt-2 d-flex flex-column justify-content-between">
                            <h5 class="card-title"><?= strtoupper($product['product_name']) ?></h5>
                            <p class="card-text"><?= number_format($product['base_price'], '2', ',') ?>€</p>
                        </div>
                    </article>

                    <?php
            }
            ?>

            </div>
        </div>
        <?php
    }
    ?>
    <!-- Se inserta javascript porque ha sido elúnico modo de poder gestionar el desplegable colapsable de los datos de la tarjeta
 tan solo a nivel visual. Los datos se gestionan con PHP. -->
</section>
<script src="public/js/effectsCheckout.js
"></script>