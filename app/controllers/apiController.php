<?php

include_once('config/params.php');
include_once('app/models/OrderDAO.php');
include_once('app/models/Log.php');
include_once('app/models/LogDAO.php');
class apiController
{

    public function show()
    {
        include_once('config/apiHeaders.php');


        $data = OrderDAO::findAllOrders();

        if (!empty($data)) {

            echo json_encode(['status' => 200, 'data' => $data]);
        } else {
            http_response_code(404);
            echo json_encode(['status' => 404, 'data' => 'No data found']);
        }

    }

    public function showLogs()
    {
        include_once('config/apiHeaders.php');


        $data = LogDAO::getLogs();

        if (!empty($data)) {

            $log = new Log();
            $log->setAction('SELECT');
            $log->setUser_id($_SESSION['id']);
            $log->setAltered_table('ORDERS');
            $log->setObject_id(null);

            LogDAO::insertLog($log);
            echo json_encode(['status' => 200, 'data' => $data]);
        } else {
            http_response_code(404);
            echo json_encode(['status' => 404, 'data' => 'No data found']);
        }

    }



    public function deleteOrder()
    {
        include_once('config/apiHeaders.php');
        $id = json_decode(file_get_contents('php://input'), true);
        $response = OrderDAO::removeOrderDetails($id);

        if ($response) {
            $result = OrderDAO::removeOrder($id);
            if ($result) {

                $log = new Log();
                $log->setAction('DELETE');
                $log->setUser_id($_SESSION['id']);
                $log->setAltered_table('ORDERS');
                $log->setObject_id($id);

                LogDAO::insertLog($log);
                http_response_code(200);
                echo json_encode(['status' => 200, 'message' => 'Pedido eliminado con éxito']);
            } else {

                http_response_code(500);
                echo json_encode(['status' => 500, 'message' => 'No se pudo eliminar el pedido principal']);
            }

        } else {
            http_response_code(500);
            echo json_encode(['status' => 500, 'message' => 'Error al borrar los detalles del pedido']);
        }

    }
    public function updateOrder()
    {
        include_once('config/apiHeaders.php');

        $order = json_decode(file_get_contents('php://input'), true);
        if (strlen($order['cardNumber']) != 4 && $order['cardNumber'] != null) {
            http_response_code(400);
            echo json_encode(['status' => 400, 'message' => 'El valor introducido no tiene 4 dígitos']);
            return;
        }
        var_dump($order);
        $response = OrderDAO::updateOrder($order);

        if ($response) {

            $log = new Log();
            $log->setAction('UPDATE');
            $log->setUser_id($_SESSION['id']);
            $log->setAltered_table('ORDERS');
            $log->setObject_id($order['id']);

            LogDAO::insertLog($log);
            http_response_code(200);
            echo json_encode(['status' => 200, 'message' => 'Pedido eliminado con éxito']);

        } else {
            http_response_code(500);
            echo json_encode(['status' => 500, 'message' => 'No se pudo eliminar el pedido principal']);
        }

    }

    public function createOrder()
    {
        include_once('config/apiHeaders.php');

        $response = json_decode(file_get_contents('php://input'), true);
        if (strlen($response['cardNumber']) != 4 && $response['cardNumber'] != null) {
            http_response_code(400);
            echo json_encode(['status' => 400, 'message' => 'El valor introducido no tiene 4 dígitos']);
            return;
        }
        $order = new Order();
        $order->setUser_id($response['userId']);
        $order->setStatus($response['status']);
        $order->setTotal_amount($response['totalAmount']);
        $order->setCard_number($response['cardNumber']);
        $order->setPromotion_id($response['promotionId']);
        $order->setPayment_method($response['paymentMethod']);
        $order->setDelivery_cost($response['deliveryCost']);
        $order->setIva($response['iva']);

        $result = OrderDAO::insertOrder($order);

        if ($result) {
            $log = new Log();
            $log->setAction('INSERT');
            $log->setUser_id($_SESSION['id']);
            $log->setAltered_table('ORDERS');
            $log->setObject_id($result);

            LogDAO::insertLog($log);

            http_response_code(200);
            echo json_encode(['status' => 200, 'message' => 'Pedido introducido con éxito']);

        } else {
            http_response_code(500);
            echo json_encode(['status' => 500, 'message' => 'No se pudo introducir el pedido']);
        }

    }

}