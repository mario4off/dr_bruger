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