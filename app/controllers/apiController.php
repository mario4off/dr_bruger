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
        $method = $_SERVER['REQUEST_METHOD'];

        switch ($method) {

            case 'GET':

                self::showAll();

                break;

            case 'DELETE':
                $id = json_decode(file_get_contents('php://input'), true);
                $response = self::deleteOrder($id);

                if ($response == 'ok') {
                    echo json_encode(['status' => 200, 'data' => 'Borrado con éxito']);
                } else {
                    http_response_code(404);
                    echo json_encode(['status' => 404, 'data' => 'Pedido no encontrado']);
                }

                break;
        }
    }

    private function showAll()
    {
        $data = OrderDAO::findAllOrders();

        if (!empty($data)) {

            echo json_encode(['status' => 200, 'data' => $data]);
        } else {
            http_response_code(404);
            echo json_encode(['status' => 404, 'data' => 'No data found']);
        }
    }

    private function deleteOrder($id)
    {


        $response = OrderDAO::removeOrderDetails($id);

        if ($response) {
            return OrderDAO::removeOrder($id);
        } else {
            header('Location: ?controller=admin&action=pannel&error=unable_to_delete');
        }

    }
    // function showWithFilter()
// {
//     $data = adminController::getFilteredOrders();

    //     if (!empty($data)) {

    //         echo json_encode(['status' => 200, 'data' => $data]);
//     } else {
//         http_response_code(404);
//         echo json_encode([['status' => 404, 'data' => 'No data found']]);
//     }
// }
}