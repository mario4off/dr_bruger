<?php

include_once('config/params.php');
include_once('app/models/OrderDAO.php');
include_once('app/models/Log.php');
include_once('app/models/LogDAO.php');
class apiController
{

    public function show()
    {
        // Este método gestiona la entrada al panel de administración y la carga de sus datos a través de la llamada
        // a la api. Carga todos los datos de cada pedido
        include_once('config/apiHeaders.php');


        $data = OrderDAO::findAllOrders();

        // Esto es recurrente en toda las acciones de select que registran en la tabla de logs la acción realizada
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

    public function showLogs()
    {
        include_once('config/apiHeaders.php');
        // Método para mostrar los logs en llamada de la api y los carga
        $data = LogDAO::getLogs();

        if (!empty($data)) {

            echo json_encode(['status' => 200, 'data' => $data]);
        } else {
            http_response_code(404);
            echo json_encode(['status' => 404, 'data' => 'No data found']);
        }

    }


    public function showUsers()
    {
        include_once('config/apiHeaders.php');

        // Carga todos los usuarios de la base de datos y realiza el registro de actividad
        $data = UserDAO::getAllUsers();

        if (!empty($data)) {

            $log = new Log();
            $log->setAction('SELECT');
            $log->setUser_id($_SESSION['id']);
            $log->setAltered_table('USERS');
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
        // Llamada de la api que a partide un id elimina un pedido
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
    public function deleteUser()
    {
        include_once('config/apiHeaders.php');
        $id = json_decode(file_get_contents('php://input'), true);
        // Llamada a la api que elimina un usuario con el id del pedido
        $result = UserDAO::destroyUser($id);
        if ($result) {

            $log = new Log();
            $log->setAction('DELETE');
            $log->setUser_id($_SESSION['id']);
            $log->setAltered_table('USERS');
            $log->setObject_id($id);

            LogDAO::insertLog($log);
            http_response_code(200);
            echo json_encode(['status' => 200, 'message' => 'Usuario eliminado con éxito']);
        } else {

            http_response_code(500);
            echo json_encode(['status' => 500, 'message' => 'No se pudo eliminar al usuario']);
        }


    }
    public function updateOrder()
    {
        include_once('config/apiHeaders.php');

        // Se realiza la actualización del pedido si el datos de la tarjeta tiene 4 números
        $order = json_decode(file_get_contents('php://input'), true);
        if (strlen($order['cardNumber']) != 4 && $order['cardNumber'] != null) {
            http_response_code(400);
            echo json_encode(['status' => 400, 'message' => 'El valor introducido no tiene 4 dígitos']);
            return;
        }

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
    public function updateUser()
    {
        include_once('config/apiHeaders.php');
        // Se manda al dao un objeto user para modificarlo en la base de datos
        $response = json_decode(file_get_contents('php://input'), true);

        $user = new User();
        $user->setName($response['name']);
        $user->setLast_name($response['last_name']);
        $user->setAddress($response['address'] ?? ' ');
        $user->setMail($response['mail']);
        $user->setCity($response['city']);
        $user->setCp($response['cp']);
        $user->setPhone($response['phone']);
        $user->setPass($response['pass']);
        $user->setRole($response['role']);
        $user->setUser_id($response['user_id']);

        $result = UserDAO::updateUser($user);

        if ($result) {

            $log = new Log();
            $log->setAction('UPDATE');
            $log->setUser_id($_SESSION['id']);
            $log->setAltered_table('USERS');
            $log->setObject_id($user->getUser_id());

            LogDAO::insertLog($log);
            http_response_code(200);
            echo json_encode(['status' => 200, 'message' => 'Usuario editado con éxito']);

        } else {
            http_response_code(500);
            echo json_encode(['status' => 500, 'message' => 'No se ha podido editar el usuario']);
        }

    }

    public function createOrder()
    {

        // Método que crea un pedido
        include_once('config/apiHeaders.php');
        // Comprueba que la tarjeta tenga 4 d'ígitos
        $response = json_decode(file_get_contents('php://input'), true);
        if (strlen($response['cardNumber']) != 4 && $response['cardNumber'] != null) {
            http_response_code(400);
            echo json_encode(['status' => 400, 'message' => 'El valor introducido no tiene 4 dígitos']);
            return;
        }
        // Se crea un objeto order que se mandará al DAO para registrar el pedido
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
    public function createUser()
    {
        include_once('config/apiHeaders.php');

        $response = json_decode(file_get_contents('php://input'), true);
        // Función que crea un usuario nuevo mandado al dao los datos recibidos del javascript en forma de
        // objeto User
        $user = new User();
        $user->setName($response['name']);
        $user->setLast_name($response['lastName']);
        $user->setMail($response['mail']);
        $user->setPhone($response['phone']);
        $user->setRole($response['role']);
        $user->setPass(password_hash($response['pass'], PASSWORD_DEFAULT));
        $user->setCity($response['city']);
        $user->setCp($response['cp']);
        $user->setAddress($response['address']);

        $result = userDAO::insertUser($user);

        if ($result) {
            $log = new Log();
            $log->setAction('INSERT');
            $log->setUser_id($_SESSION['id']);
            $log->setAltered_table('USERS');
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