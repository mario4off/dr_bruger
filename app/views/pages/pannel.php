<main class="container  mt-4 mb-4">
    <h1 class="ms-0 m-4">PANEL DE ADMINISTRACIÓN</h1>
    <section class="d-flex">
        <aside class="col-2 me-3">
            <form class="mb-4">
                <div class="d-flex gap-3 mb-2">
                    <p>Ordenar por:</p><select name="order" id="select-order">

                        <option value="orderId">Pedido ID</option>
                        <option value="userId">Usuario ID</option>
                        <option value="dateTime">Fecha</option>
                        <option value="totalAmount">Precio</option>
                    </select>
                </div>

                <!-- <label for="id"><strong>Valor de búsqueda:<strong></label>
                <input type="number" id="id">
                <input id="until" hidden> -->
            </form>

            <button class="snd-btn-1 mb-2 w-100 mt-5">ADMINISTRAR PEDIDOS</button>
            <button class="snd-btn-1 w-100">HISTORIAL DE ACTIVIDAD</button>

        </aside>
        <div class="col-10 ">

            <!-- <select name="filter" id="filter" value="Filtrar por...">
                <option value="all">Todos</option>
                <option value="user">Usuario</option>
                <option value="price">Precio</option>
                <option value="date">Fecha</option>
            </select> -->
            <div>

            </div>
            <table>
                <thead>
                    <tr>
                        <th class="text-center align-top">PEDIDO ID</th>
                        <th class="text-center align-top">USUARIO ID</th>
                        <th class="text-center align-top">ESTADO</th>
                        <th class="text-center align-top">FECHA & HORA</th>
                        <th class="text-center align-top">MÉTODO DE PAGO</th>
                        <th class="text-center align-top">NÚM. TARJETA</th>
                        <th class="text-center align-top">ALERGIAS & COMENTARIOS</th>
                        <th class="text-center align-top">PRECIO TOTAL</th>
                        <th class="text-center align-top">IVA</th>
                        <th class="text-center align-top">PROMOCION_ID</th>
                        <th class="text-center align-top">PRECIO ENVÍO</th>
                        <th class="text-center align-top"></th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </section>
</main>
<script type="module" src="public/js/createTable.js"></script>