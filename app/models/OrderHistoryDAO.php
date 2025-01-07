<?php

class OrderHistoryDAO
{
    public static function getOrderHistoryByUser($id)
    {
        $con = Database::connect();

        $stmnt = $con->prepare("SELECT orders.order_id,orders.user_id,orders.promotion_id,orders.date_time,orders.status, orders.delivery_cost
        ,orders.total_amount,orders.card_number, orders.payment_method, order_details.quantity,order_details.line_price, products.product_name, products.product_id 
        FROM orders JOIN order_details ON orders.order_id = order_details.order_id
        JOIN products ON  products.product_id = order_details.product_id 
        WHERE user_id = ? ORDER BY orders.date_time DESC");
        $stmnt->bind_param("i", $id);

        $stmnt->execute();

        $result = $stmnt->get_result();

        $orderHistory = [];

        while ($row = $result->fetch_object('OrderHistory')) {

            $orderHistory[] = $row;
        }

        $con->close();

        return $orderHistory;
    }


}