<?php

include_once('config/protection.php');
include_once('app/models/CartItemDAO.php');
include_once('app/models/CartItem.php');
include_once('app/models/Order.php');
include_once('app/models/OrderDAO.php');
include_once('app/models/Promotion.php');
include_once('app/models/PromotionDAO.php');
include_once('app/models/OrderDetails.php');
include_once('app/models/OrderDetailsDAO.php');
include_once('config/params.php');
include_once('config/Database.php');

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


        $view = 'app/views/pages/checkout.php';
        include_once('app/views/layouts/main.php');

    }

    public function getCheckout()
    {
        $view = 'app/views/pages/checkout.php';
        include_once('app/views/layouts/main.php');
    }

    public function removeItem()
    {
        $productId = $_GET['productId'];

        unset($_SESSION['cart'][$productId]);

        if (count($_SESSION['cart']) == 0) {
            unset($_SESSION['cart']);
        }
        $view = 'app/views/pages/checkout.php';
        include_once('app/views/layouts/main.php');
    }

    public function addUnit()
    {
        $productId = $_GET['productId'];

        $_SESSION['cart'][$productId]->setQuantity($_SESSION['cart'][$productId]->getQuantity() + 1);
        $view = 'app/views/pages/checkout.php';
        include_once('app/views/layouts/main.php');
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

        $view = 'app/views/pages/checkout.php';
        include_once('app/views/layouts/main.php');
    }

    public function makeOrder()
    {

        if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {

            $user_id = $_SESSION['id'];
            // $promotion_id = $_POST[''];
            $status = 'Pendiente de aceptación';
            $total_amount = $_SESSION['totalAmount'];
            $card_number = (isset($_POST['card-num']) && !empty($_POST['card-num'])) ? substr($_POST['card-num'], 12, 16) : null;
            $payment_method = $_POST['payment-option'];
            $delivery_cost = $_GET['delivery'] == 'true' ? 3.5 : 0;
            $iva = round(self::calculateTax($total_amount, $delivery_cost), 2);

            $order = new Order();

            $order->setUser_id($user_id);
            $order->setStatus($status);
            $order->setTotal_amount($total_amount);
            $order->setCard_number($card_number);
            $order->setPayment_method($payment_method);
            $order->setDelivery_cost($delivery_cost);
            $order->setIva($iva);
            if (isset($_SESSION['discount']['discountId']) && !empty($_SESSION['discount']['discountId'])) {
                $order->setPromotion_id($_SESSION['discount']['discountId']);
                $promoId = $order->getPromotion_id();
            } else {
                $order->setPromotion_id(null);
            }

            $orderId = OrderDAO::insertOrder($order);

            if (isset($_SESSION['discount']['productId']) && !empty($_SESSION['discount']['productId'])) {
                $productId = $_SESSION['discount']['prodcutId'];
                $discountedPrice = $_SESSION['discount']['amount'];

                $result = OrderDetailsDAO::insertOrderLines($orderId, $promoId, $productId, $discountedPrice);
            } else {
                $result = OrderDetailsDAO::insertOrderLines($orderId);
            }


            if ($result) {
                unset($_SESSION['cart']);
                unset($_SESSION['totalAmount']);
                unset($_SESSION['discount']);
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

    public function applyPromo()
    {

        $promo = $_POST['discount-code'];
        $orderAmount = $_POST['orderAmount'];

        if (isset($_SESSION['id'])) {
            $discount = PromotionDAO::checkPromo($promo);

            if (empty($discount)) {

                header('Location: ?controller=order&action=getCheckout&warning=invalid_code');
            }

            $currentDate = date('Y-m-d');

            if ($discount->getStart_date() < $currentDate && $currentDate <= $discount->getEnd_date()) {


                if ($discount->getProduct_id() == null) {

                    $result = PromotionDAO::isOrderPromoApplied($discount->getPromotion_id());

                    if (!$result) {

                        if ($discount->getDiscount_type() == 'percentage') {

                            $_SESSION['discount']['amount'] = $orderAmount * ($discount->getDiscount_value() / 100);
                            $_SESSION['discount']['code'] = $promo;
                            $_SESSION['discount']['discountId'] = $discount->getPromotion_id();
                            $view = 'app/views/pages/checkout.php';
                            include_once('app/views/layouts/main.php');

                        } else {
                            $_SESSION['discount']['amount'] = $discount->getDiscount_value();
                            $_SESSION['discount']['code'] = $promo;
                            $_SESSION['discount']['discountId'] = $discount->getPromotion_id();
                            $view = 'app/views/pages/checkout.php';
                            include_once('app/views/layouts/main.php');
                        }

                    } else {
                        header('Location: ?controller=order&action=getCheckout&warning=code_already_applied');
                    }

                } else {

                    $result = PromotionDAO::isProductPromoApplied($discount->getPromotion_id(), $_SESSION['id']);

                    if (!$result) {
                        $product = ProductDAO::getProductPriceByPromoId($discount->getPromotion_id());
                        if ($discount->getDiscount_type() == 'percentage') {

                            $_SESSION['discount']['amount'] = $product->getBase_price() * ($discount->getDiscount_value() / 100);
                            $_SESSION['discount']['code'] = $promo;
                            $_SESSION['discount']['discountId'] = $discount->getPromotion_id();
                            $_SESSION['discount']['productId'] = $product->getProduct_id();

                            $view = 'app/views/pages/checkout.php';
                            include_once('app/views/layouts/main.php');

                        } else {
                            $_SESSION['discount']['amount'] = $discount->getDiscount_value();
                            $_SESSION['discount']['code'] = $promo;
                            $_SESSION['discount']['discountId'] = $discount->getPromotion_id();
                            $_SESSION['discount']['productId'] = $product->getProduct_id();
                            $view = 'app/views/pages/checkout.php';
                            include_once('app/views/layouts/main.php');
                        }

                    } else {
                        header('Location: ?controller=order&action=getCheckout&warning=code_already_applied');
                    }

                }


            } else {

                header('Location: ?controller=order&action=getCheckout&warning=promo_expired');

            }

        } else {

            header('Location: ?controller=order&action=getCheckout&warning=login_needed');

        }
    }

    public function removeDiscount()
    {
        unset($_SESSION['discount']);
        $view = 'app/views/pages/checkout.php';
        include_once('app/views/layouts/main.php');
    }



}