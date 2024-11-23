<div class="container-fluid row ps-0">

    <div class="col-sm-12 col-md-3 ">
        <ul class="ps-0 mb-5 flex-row d-md-block ">
            <li class="mt-3"><a class="links-on-white d-none d-md-block"
                    href="?controller=user&action=showUser&section=profile">MI
                    PERFIL</a></li>
            <li class="mt-3"><a class="links-on-white d-none d-md-block"
                    href="?controller=user&action=showUser&section=orders">MIS
                    PEDIDOS</a>
            </li>
            <li class="mt-3 mb-4"><a class="snd-btn-1 fs-4 d-md-none"
                    href="?controller=user&action=showUser&section=profile">MI
                    PERFIL</a>
            </li>
        </ul>
    </div>
    <div class="col-sm-12 col-md-5">
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
                    <div class="container-sm container-order  mb-3 p-2 pt-3 pb-3">
                        <div class="order_data mb-3">
                            <div class="order-data-time d-flex gap-1">
                                <p class=""><?= str_replace(' ', '<strong> | </strong>', $order->getDate_time()) ?></p>
                            </div>
                            <div>
                                <strong class="gap-2 d-flex">
                                    <p>PEDIDO ID</p>
                                    <p><?= $order->getOrder_id() ?></p>
                                </strong>
                            </div>
                        </div>
                        <?php
                        foreach ($orderHistory as $product) {
                            if ($product->getOrder_id() == $lastIdChecked) {
                                ?>

                                <div class="w-100 d-flex gap-3 mt-1 ">

                                    <div class="w-75 d-flex justify-content-start gap-5">
                                        <p><strong><?= $product->getQuantity() ?>x</strong></p>
                                        <p><?= strtoupper($product->getProduct_name()) ?></p>
                                    </div>
                                    <p><?= str_replace('.', ',', $product->getLine_price()) ?>€</p>
                                </div>

                                <?php
                            }
                        }

                        ?>
                        <h3 class="text-dark mt-3 mb-1">TOTAL PEDIDO</h3>
                        <p><?= str_replace('.', ',', $order->getTotal_amount()) ?>€</p>
                    </div>
                    <?php
                }
            } ?>

        </div>
    </div>

</div>