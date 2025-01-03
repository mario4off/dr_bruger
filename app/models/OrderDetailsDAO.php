<?php

class OrderDetailsDAO
{
    public static function insertOrderLines($orderId, $promo = null, $promoProductId = null, $discountedPrice = null)
    {
        $con = Database::connect();

        $stmn = $con->prepare("INSERT INTO order_details (line_price, quantity, order_id, product_id, promotion_id) 
        VALUES (?,?,?,?,?)");

        foreach ($_SESSION['cart'] as $item) {

            $linePrice = $item->getBase_price() * $item->getQuantity();
            $defPromo = null;
            if ($item->getProduct_id() == $promoProductId) {
                $stmn->bind_param(
                    "diiii",
                    $discountedPrice,
                    $item->getQuantity(),
                    $orderId,
                    $item->getProduct_id(),
                    $promo
                );
                $promoProductId = null;
            } else {
                $stmn->bind_param(
                    "diiii",
                    $linePrice,
                    $item->getQuantity(),
                    $orderId,
                    $item->getProduct_id(),
                    $defPromo
                );
            }


            $stmn->execute();

        }

        $con->close();

        return 'ok';
    }
}