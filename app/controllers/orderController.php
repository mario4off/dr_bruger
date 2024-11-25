<?php

include_once(path_base . 'config/protection.php');
include_once(path_base . 'app/models/UserDAO.php');
include_once(path_base . 'app/models/User.php');
include_once(path_base . 'app/models/OrderHistoryDAO.php');
include_once(path_base . 'app/models/OrderHistory.php');
include_once(path_base . 'config/params.php');

class orderController
{

    public function repeatOrder()
    {
        $orderId = $_GET['orderId'];

        $products = OrderHistoryDAO::getProductsByOrder($orderId);

        if (isset($_SESSION['cart'])) {
            unset($_SESSION['cart']);

            foreach ($products as $product) {
                $_SESSION['cart'][$product->getProduct_id()] = $product->getQuantity();
            }
        } else {
            foreach ($products as $product) {
                $_SESSION['cart'][$product->getProduct_id()] = $product->getQuantity();
            }
        }

        $view = path_base . 'app/views/pages/home.php';
        include_once(path_base . 'app/views/layouts/main.php');

    }

}