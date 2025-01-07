<?php

class PromotionDAO
{

    public static function checkPromo($code)
    {
        $con = Database::connect();

        $stmnt = $con->prepare("SELECT * FROM promotions WHERE code LIKE ?");
        $stmnt->bind_param('s', $code);
        $stmnt->execute();
        $result = $stmnt->get_result();

        $promo = $result->fetch_object('promotion');
        if ($promo != null) {

            if ($promo->getProduct_id() != null) {
                $stmnt = $con->prepare("SELECT * FROM products WHERE promotion_id = ?");
                $stmnt->bind_param('s', $promo->getPromotion_id());
                $stmnt->execute();
                $result = $stmnt->get_result();

                if (!$result) {
                    return false;
                }
            }
            $con->close();

            return $promo;
        }

        $con->close();

    }

    public static function isOrderPromoApplied($id)
    {
        $con = Database::connect();

        $stmnt = $con->prepare("SELECT * FROM orders WHERE promotion_id = ?");
        $stmnt->bind_param('i', $id);
        $stmnt->execute();
        $result = $stmnt->get_result();

        $order = $result->fetch_assoc();

        $con->close();

        return $order;
    }

    public static function isProductPromoApplied($promoId, $userId)
    {
        $con = Database::connect();

        $stmnt = $con->prepare("SELECT * FROM order_details JOIN orders ON order_details.order_id = orders.order_id 
        WHERE order_details.promotion_id = ? AND orders.user_id = ?");
        $stmnt->bind_param('ii', $promoId, $userId);
        $stmnt->execute();
        $result = $stmnt->get_result();

        $order = $result->fetch_assoc();

        $con->close();

        return $order;
    }

}