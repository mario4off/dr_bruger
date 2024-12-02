<?php

include_once(path_base . 'config/protection.php');
include_once(path_base . 'app/models/UserDAO.php');
include_once(path_base . 'app/models/User.php');
include_once(path_base . 'app/models/OrderHistoryDAO.php');
include_once(path_base . 'app/models/OrderHistory.php');
include_once(path_base . 'app/models/CartItemDAO.php');
include_once(path_base . 'app/models/CartItem.php');
include_once(path_base . 'app/models/Order.php');
include_once(path_base . 'app/models/OrderDAO.php');
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

    public function makeOrder()
    {

        if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {

            $user_id = $_SESSION['id'];
            // $promotion_id = $_POST[''];
            $status = 'Pendiente de aceptación';
            $total_amount = $_SESSION['totalAmount'];
            $card_number = (isset($_POST['card-num']) && !empty($_POST['card-num'])) ? substr($_POST['card-num'], '8') : '';
            $payment_method = $_POST['payment-option'];
            $delivery_cost = $_GET['delivery'] == 'true' ? 3.5 : 0;
            $iva = self::calculateTax($total_amount, $delivery_cost);

            $order = new Order();

            $order->setUser_id($user_id);
            $order->setStatus($status);
            $order->setTotal_amount($total_amount);
            $order->setCard_number($card_number);
            $order->setPayment_method($payment_method);
            $order->setDelivery_cost($delivery_cost);
            $order->setIva($iva);

            $result = OrderDAO::insertOrder($order);

            if ($result) {
                unset($_SESSION['cart']);
                unset($_SESSION['totalAmount']);
                header('Location: ?controller=user&action=showUser&section=orders');
            } else {
                header('Location: ?controller=order&action=getCheckout&error=insert_order');
            }

        }

    }

    private function calculateTax($amount, $delivery_cost, $tax = 0.21)
    {
        return ($amount + $delivery_cost) * $tax;
    }

}