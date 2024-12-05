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

        $con->close();

        return $promo;

    }

    public static function isOrderPromoApplied($id)
    {
        $con = Database::connect();

        $stmnt = $con->prepare("SELECT * FROM orders WHERE promotion_id = ?");
        $stmnt->bind_param('i', $id);
        $stmnt->execute();
        $result = $stmnt->get_result();

        $order = $result->fetch_object('order');

        $con->close();

        return $order;
    }


}