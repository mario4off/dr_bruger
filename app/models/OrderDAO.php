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

        $stmnt = $con->prepare("SELECT * FROM orders ORDER BY date_time DESC");
        $stmnt->execute();
        $result = $stmnt->get_result();

        $orders = [];

        while ($row = $result->fetch_assoc()) {

            $orders[] = $row;

        }
        $con->close();

        return $orders;
    }

    public static function removeOrderDetails($id)
    {
        $con = Database::connect();

        $stmnt = $con->prepare("DELETE FROM order_details WHERE order_id = ?");
        $stmnt->bind_param("i", $id);
        $stmnt->execute();
        $con->close();
        return 'ok';
    }
    public static function removeOrder($id)
    {
        $con = Database::connect();

        $stmnt = $con->prepare("DELETE FROM orders WHERE order_id = ?");
        $stmnt->bind_param("i", $id);
        $stmnt->execute();
        $con->close();
        return 'ok';
    }

    public static function updateOrder($order)
    {
        $con = Database::connect();

        $stmnt = $con->prepare("UPDATE orders SET status = ?, payment_method = ?, card_number = ? WHERE order_id = ? ORDER BY date_time DESC");
        $stmnt->bind_param(
            "ssii",
            $order['status'],
            $order['paymentMethod'],
            $order['cardNumber'],
            $order['id']
        );
        $stmnt->execute();
        $con->close();
        return 'ok';
    }

}