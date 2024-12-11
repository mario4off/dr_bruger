<main class="container  mt-4 mb-4">
    <h1 class="ms-0 m-4">PANEL DE ADMINISTRACIÓN</h1>
    <section class="d-flex">
        <aside class="col-2 me-3">
            <button class="snd-btn-1 mb-2 w-100">ADMINISTRAR PEDIDOS</button>
            <button class="snd-btn-1 w-100">HISTORIAL DE ACTIVIDAD</button>
        </aside>
        <div class="col-10 bg-primary">

            <!-- <select name="filter" id="filter" value="Filtrar por...">
                <option value="all">Todos</option>
                <option value="user">Usuario</option>
                <option value="price">Precio</option>
                <option value="date">Fecha</option>
            </select> -->

            <table>
                <thead>
                    <tr>
                        <th>PEDIDO_ID</th>
                        <th>USUARIO_ID</th>
                        <th>ESTADO</th>
                        <th>FECHA & HORA</th>
                        <th>PROMOCION_ID</th>
                        <th>PRECIO TOTAL</th>
                        <th>MÉTODO DE PAGO</th>
                        <th>NÚM. TARJETA</th>
                        <th>PRECIO ENVÍO</th>
                        <th>IVA</th>
                        <th>ALERGIAS & COMENTARIOS</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </section>
</main>
<script type="module" src="public/js/createTable.js"></script>