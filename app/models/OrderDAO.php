<?php
class OrderDAO
{


    public static function insertOrder($order)
    {

        $con = Database::connect();

        $stmnt = $con->prepare("INSERT INTO orders (user_id,status,total_amount,card_number,payment_method,
        delivery_cost,iva) VALUES (?,?,?,?,?,?,?)");
        $stmnt->bind_param(
            "isdisdd",
            $order->getUser_id(),
            $order->getStatus(),
            $order->getTotal_amount(),
            $order->getCard_number(),
            $order->getPayment_method(),
            $order->getDelivery_cost(),
            $order->getIva()
        );

        $stmnt->execute();

        $con->close();

        return $stmnt->insert_id;
    }

    public static function findAllOrders()
    {
        $con = Database::connect();

        $stmnt = $con->prepare("SELECT * FROM orders");
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