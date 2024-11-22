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
    <div class="col-9">
        <h2 class="mb-1">HISTORIAL DE PEDIDOS</h2>
        <p><?php
        $orderQuantity = 0;
        $auxId = 0;
        foreach ($orderHistory as $data) {
            if ($auxId != $data->getOrder_id()) {
                $auxId = $data->getOrder_id();
                $orderQuantity++;
            } else {
                continue;
            }
        }
        echo $orderQuantity == 0 ? 'No hay pedidos registrados' : 'Tienes ' . $orderQuantity . ' pedidos registrados';
        ?>
        </p>
        <div class=" ps-0 container w-100 mt-3">

            <?php
            $lastIdChecked = 0;
            foreach ($orderHistory as $order) {
                //  $lastIdChecked= $data->getOrder_id();
                if ($lastIdChecked != $order->getOrder_id()) {

                    $lastIdChecked = $order->getOrder_id();
                    ?>
                    <div class="container container-order w-50 mb-3">
                        <div class="order_data mb-2">
                            <div class="order-data-time d-flex gap-1">
                                <p class=""><?= str_replace(' ', '<strong> | </strong>', $order->getDate_time()) ?></p>
                            </div>
                            <div class="gap-2 d-flex">
                                <p>PEDIDO ID</p>
                                <p><?= $order->getOrder_id() ?></p>
                            </div>
                        </div>
                        <?php
                        foreach ($orderHistory as $product) {
                            if ($product->getOrder_id() == $lastIdChecked) {
                                ?>

                                <div class="w-100 d-flex gap-3 mt-1 ">

                                    <div class="w-50 d-flex justify-content-start gap-5">
                                        <p><?= $product->getQuantity() ?><strong>x</strong></p>
                                        <p><?= $product->getProduct_name() ?></p>
                                    </div>
                                    <p><?= $product->getLine_price() ?>€</p>
                                </div>

                                <?php
                            }
                        }

                        ?>
                        <h3 class="text-dark mt-3 mb-1">TOTAL PEDIDO</h3>
                        <p><?= $order->getTotal_amount() ?>€</p>
                    </div>
                    <?php
                }
            } ?>

        </div>
    </div>

</div>