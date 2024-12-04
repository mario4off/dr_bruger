<?php

class OrderDetailsDAO
{
    public static function insertOrderLines($orderId, $promo = null)
    {
        $con = Database::connect();

        $stmn = $con->prepare("INSERT INTO order_details (line_price, quantity, order_id, product_id, promotion_id) 
        VALUES (?,?,?,?,?)");

        foreach ($_SESSION['cart'] as $item) {
            $linePrice = $item->getBase_price() * $item->getQuantity();
            $stmn->bind_param(
                "diiii",
                $linePrice,
                $item->getQuantity(),
                $orderId,
                $item->getProduct_id(),
                $promo
            );

            $stmn->execute();

        }

        $con->close();

        return 'ok';
    }
}