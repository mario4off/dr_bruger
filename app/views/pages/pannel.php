<main class="container  mt-4 mb-4">
    <h1 class="ms-0 m-4">PANEL DE ADMINISTRACIÓN</h1>
    <section class="d-flex">
        <aside class="col-2 me-3">
            <form class="">
                <div class="d-flex gap-3 mt-2">
                    <p>Ordenar por:</p><select name="order" id="select-order">

                        <option value="orderId">Pedido ID</option>
                        <option value="userId">Usuario ID</option>
                        <option value="dateTime">Fecha</option>
                        <option value="totalAmount">Precio</option>
                    </select>
                </div>

            </form>

            <button class="snd-btn-1 mb-2 w-100 mt-4">ADMINISTRAR PEDIDOS</button>
            <button class="snd-btn-1 w-100">HISTORIAL DE ACTIVIDAD</button>

        </aside>
        <div class="col-10 ">
            <div class="d-flex justify-content-end w-100">

                <div class="accordion accordion-flush" id="accordionFlushExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingOne">
                            <button
                                class="w-100 d-flex align-items-center justify-content-end gap-4 collapsed snd-btn-2"
                                type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne"
                                aria-expanded="false" aria-controls="flush-collapseOne">

                                <p>AÑADIR PEDIDO</p>
                            </button>
                        </h2>
                        <div id="flush-collapseOne" class="accordion-collapse collapse"
                            aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">Placeholder content for this accordion, which is intended to
                                demonstrate the <code>.accordion-flush</code> class. This is the first item's accordion
                                body.</div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="d-flex flex-row filters-admin-div p-2 mt-2 gap-5">
                <!-- <h2 class="fs-6 mb-2">FILTROS</h2> -->

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
                <div>
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