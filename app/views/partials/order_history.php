<div class="container-fluid row ps-0">

    <div class="col-3 d-flex justify-content-start">
        <ul class="ps-0">
            <li class="mt-3"><a class="links-on-white" href="?controller=user&action=showUser&section=profile">MI
                    PERFIL</a></li>
            <li class="mt-3"><a class="links-on-white" href="?controller=user&action=showUser&section=orders">MIS
                    PEDIDOS</a>
            </li>
        </ul>
    </div>
    <div class="col-9 bg-primary">
        <div class="container">
            <h2 class="mb-1">HISTORIAL DE PEDIDOS</h2>
            <p><?= count($orders) == 0 ? 'No hay pedidos registrados' : 'Tienes ' . count($orders) . ' pedidos registrados'; ?>
            </p>
            <div class="container container-order">
                <div id="date-time-order">
                    <p class="order-date">Fecha</p>
                    <p class="order-time">Hora</p>
                </div>

            </div>

        </div>
    </div>

</div>