<?php

include_once('/Applications/XAMPP/xamppfiles/htdocs/drburger.com/config/params.php');
include_once(path_base . 'app/models/OrderDAO.php');
class apiController
{

    public function show()
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


        $data = OrderDAO::findAllOrders();

        if (!empty($data)) {

            echo json_encode(['status' => 200, 'data' => $data]);
        } else {
            http_response_code(404);
            echo json_encode(['status' => 404, 'data' => 'No data found']);
        }

    }



    public function deleteOrder()
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
        $id = json_decode(file_get_contents('php://input'), true);
        $response = OrderDAO::removeOrderDetails($id);

        if ($response) {
            $result = OrderDAO::removeOrder($id);
            if ($result) {

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
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

        $order = json_decode(file_get_contents('php://input'), true);
        var_dump($order);
        $response = OrderDAO::updateOrder($order);

        if ($response) {

            http_response_code(200);
            echo json_encode(['status' => 200, 'message' => 'Pedido eliminado con éxito']);

        } else {
            http_response_code(500);
            echo json_encode(['status' => 500, 'message' => 'No se pudo eliminar el pedido principal']);
        }

    }

}