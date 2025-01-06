<main class="container  mt-4 mb-4">
    <h1 class="ms-0 m-4">PANEL DE ADMINISTRACIÓN</h1>
    <section class="d-flex">
        <aside class="col-2 me-3">
            <form id="order-filter">
                <div class="d-flex gap-3 mt-2">
                    <p>Ordenar por:</p><select name="order" id="select-order">

                        <option value="orderId">Pedido ID</option>
                        <option value="userId">Usuario ID</option>
                        <option value="dateTime">Fecha</option>
                        <option value="totalAmount">Precio</option>
                    </select>
                </div>

            </form>

            <button id="order-btn" class="snd-btn-1 mb-2 w-100 mt-5">PEDIDOS</button>
            <button id="user-btn" class="snd-btn-1 mb-2 w-100">USUARIOS</button>

            <button id="activity-btn" class="snd-btn-1 w-100">ACTIVIDAD</button>

        </aside>
        <div class="col-10">
            <div class="d-flex justify-content-end w-100">

                <div class="accordion accordion-flush" id="accordionFlushExample">
                    <div class="accordion-item">
                        <div class="accordion-header d-flex gap-2" id="flush-headingOne">
                            <button id="btn-toggle"
                                class="w-100 d-flex align-items-center justify-content-end gap-4 collapsed snd-btn-2"
                                type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne"
                                aria-expanded="false" aria-controls="flush-collapseOne">

                                <p id="text-insert">AÑADIR PEDIDO</p>
                            </button>
                            <button id="convert-to-dollar" class="snd-btn-2" hidden>
                                <p class="d-flex gap-4 fs-5 align-items-center">€<i
                                        class="fa-solid fa-arrow-right"></i>$</p>
                            </button>
                            <button id="convert-to-euro" class="snd-btn-2" hidden>
                                <p class="d-flex gap-4 fs-5 align-items-center">$<i
                                        class="fa-solid fa-arrow-right"></i>€</p>
                            </button>

                        </div>
                        <form id="flush-collapseOne" class="accordion-collapse collapse"
                            aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body w-100 pb-0">
                                <div id="div-insert-order" class="d-flex gap-4">
                                    <div class="d-flex flex-column">
                                        <label for="">USUARIO</label>
                                        <input id="input-user" class="" type="number">
                                    </div>
                                    <div class="d-flex flex-column">
                                        <label for="">PAGO</label>
                                        <select class="h-100" id="input-payment" value="Efectivo">
                                            <option value="Efectivo">Efectivo</option>
                                            <option value="Tarjeta">Tarjeta</option>
                                            <option value="Paypal">Paypal</option>
                                        </select>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <label for="">Núm. tarjeta</label>
                                        <input id="input-card" class="" type="number">
                                    </div>
                                    <div class="d-flex flex-column">
                                        <label for="">Alergias</label>
                                        <input id="input-allergies" type="text">
                                    </div>
                                    <div class="d-flex flex-column">
                                        <label for="">PRECIO</label>
                                        <input id="input-total-price" type="text">
                                    </div>
                                    <div class="d-flex flex-column">
                                        <label for="">ENVÍO</label>
                                        <select class="h-100" id="input-delivery" value="Recogida">
                                            <option value="0.00">Recogida</option>
                                            <option value="3.50">A domicilio</option>

                                        </select>
                                    </div>

                                </div>
                                <div id="div-insert-user" hidden="true">
                                    <div>
                                        <div class="d-flex flex-column">
                                            <label for="">NOMBRE</label>
                                            <input id="input-name" class="" type="text">
                                        </div>
                                        <div class="d-flex flex-column">
                                            <label for="">APELLIDO</label>
                                            <input id="input-lastname" class="" type="text">
                                        </div>

                                    </div>

                                    <div>
                                        <div class="d-flex flex-column">
                                            <label for="">MAIL</label>
                                            <input id="input-mail" class="" type="mail">
                                        </div>
                                        <div class="d-flex flex-column">
                                            <label for="">ROL</label>
                                            <select class="h-100" id="input-role" value="customer">
                                                <option value="customer">customer</option>
                                                <option value="admin">admin</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="d-flex flex-column">
                                        <label for="">TELÉFONO</label>
                                        <input id="input-phone" class="" type="text">
                                    </div>
                                    <div>
                                        <div class="d-flex flex-column">
                                            <label for="">DIRECCIÓN</label>
                                            <input id="input-address" class="" type="text">
                                        </div>
                                        <div class="d-flex flex-column">
                                            <label for="">CIUDAD</label>
                                            <input id="input-city" class="" type="text">
                                        </div>

                                    </div>
                                    <div>
                                        <div class="d-flex flex-column">
                                            <label for="">CP</label>
                                            <input id="input-cp" class="" type="text">
                                        </div>

                                    </div>
                                </div>


                                <div class="d-flex justify-content-end mt-4">
                                    <button type="submit" id="btn-insert-order" class="snd-btn-2">REGISTRAR
                                        PEDIDO</button>
                                </div>

                                <div class="d-flex justify-content-end mt-4">
                                    <button type="submit" id="btn-insert-user" class="snd-btn-2" hidden="true">REGISTRAR
                                        USUARIO</button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>

            <div class="filters-admin-div p-2 mt-2 gap-5" id="filters">


                <div>
                    <p>FECHA</p>
                    <div class="d-flex">
                        <div><label for="">Desde:</label>
                            <input class="date-from" type="date">
                        </div>
                        <div>
                            <label for="">Hasta:</label>
                            <input class="date-until" type="date">
                        </div>
                    </div>
                </div>
                <div id="filter-price">
                    <p>PRECIO
                    </p>
                    <div class="d-flex">
                        <div><label for="">Desde:</label>
                            <input class=" price-from " type="number">
                        </div>
                        <div>
                            <label for="">Hasta:</label>
                            <input class="price-until " type="number">
                        </div>
                    </div>
                </div>
                <div class="d-flex flex-column justify-content-end"> <label for="">USUARIO ID</label>
                    <input class="w-50" id="user-filter" type="number">
                </div>
            </div>
            <table class="mt-3 mb-4">
                <thead>

                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </section>
</main>
<script type="module" src="public/js/createTable.js"></script>
<script type="module" src="public/js/showUsers.js"></script>
<script src="public/js/showLogs.js"></script>