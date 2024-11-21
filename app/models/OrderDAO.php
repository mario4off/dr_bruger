<?php

class OrderDAO
{
    public static function getAllOrdersByUser($id)
    {
        $con = Database::connect();

        $stmnt = $con->prepare("SELECT orders.order_id,orders.user_id,orders.promotion_id,orders.date_time,orders.status
        ,orders.total_amount,orders.card_number, orders.payment_method, order_details.quantity, products.product_name 
        FROM orders JOIN order_details ON orders.order_id = order_details.order_id
        JOIN products ON  products.product_id = order_details.product_id 
        WHERE user_id = ?");
        $stmnt->bind_param("i", $id);

        $stmnt->execute();

        $result = $stmnt->get_result();

        $orders = [];

        while ($row = $result->fetch_assoc()) {

            $orders[] = $row;
        }

        $con->close();

        return $orders;
    }
}