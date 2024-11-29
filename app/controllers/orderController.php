<?php

include_once(path_base . 'config/protection.php');
include_once(path_base . 'app/models/UserDAO.php');
include_once(path_base . 'app/models/User.php');
include_once(path_base . 'app/models/OrderHistoryDAO.php');
include_once(path_base . 'app/models/OrderHistory.php');
include_once(path_base . 'app/models/CartItemDAO.php');
include_once(path_base . 'app/models/CartItem.php');
include_once(path_base . 'config/params.php');

class orderController
{

    public function repeatOrder()
    {
        $orderId = $_GET['orderId'];

        $products = CartItemDAO::getProductsByOrder($orderId);

        if (isset($_SESSION['cart'])) {
            unset($_SESSION['cart']);

            foreach ($products as $product) {

                $_SESSION['cart'][$product->getProduct_id()] = $product;
            }
        } else {
            foreach ($products as $product) {
                $_SESSION['cart'][$product->getProduct_id()] = $product;
            }
        }


        $view = path_base . 'app/views/pages/checkout.php';
        include_once(path_base . 'app/views/layouts/main.php');

    }

    public function getCheckout()
    {
        $view = path_base . 'app/views/pages/checkout.php';
        include_once(path_base . 'app/views/layouts/main.php');
    }

    public function removeItem()
    {
        $productId = $_GET['productId'];

        unset($_SESSION['cart'][$productId]);

        if (count($_SESSION['cart']) == 0) {
            unset($_SESSION['cart']);
        }
        $view = path_base . 'app/views/pages/checkout.php';
        include_once(path_base . 'app/views/layouts/main.php');
    }

    public function addUnit()
    {
        $productId = $_GET['productId'];

        $_SESSION['cart'][$productId]->setQuantity($_SESSION['cart'][$productId]->getQuantity() + 1);
        $view = path_base . 'app/views/pages/checkout.php';
        include_once(path_base . 'app/views/layouts/main.php');
    }
    public function removeUnit()
    {
        $productId = $_GET['productId'];
        if ($_SESSION['cart'][$productId]->getQuantity() >= 2) {
            $_SESSION['cart'][$productId]->setQuantity($_SESSION['cart'][$productId]->getQuantity() - 1);
        } elseif ($_SESSION['cart'][$productId]->getQuantity() == 1) {
            unset($_SESSION['cart'][$productId]);
            if (count($_SESSION['cart']) == 0) {
                unset($_SESSION['cart']);
            }
        }

        $view = path_base . 'app/views/pages/checkout.php';
        include_once(path_base . 'app/views/layouts/main.php');
    }

}