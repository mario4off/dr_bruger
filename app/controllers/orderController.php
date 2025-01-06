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

    // Este método se encarga de gestionar repetir pedido desde el historial de pedidos
    public function repeatOrder()
    {
        $orderId = $_GET['orderId'];

        // Pide todos los productos de un pedido y en concreto sus id para configurar un nuevo carrito
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
        // Método que carga la vista para finalizar el pedido
        $view = 'app/views/pages/checkout.php';
        include_once('app/views/layouts/main.php');
    }

    public function removeItem()
    {

        // Este método elimina por completo un elemento de la variable de sesión del carrito
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
        // Aumenta unidades de un elemento del carrito
        $productId = $_GET['productId'];

        $_SESSION['cart'][$productId]->setQuantity($_SESSION['cart'][$productId]->getQuantity() + 1);
        $view = 'app/views/pages/checkout.php';
        include_once('app/views/layouts/main.php');
    }
    public function removeUnit()
    {
        // Reduce unidades del carrito siempre y cuando sea posible, si no directamente quita el producto
        // del carrito
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
        // Se gestiona la recepción del pedido a trav;es del carrito
        if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {

            // Con los datos recibidos por POST se completan los datos del pedido
            $user_id = $_SESSION['id'];
            $status = 'Pendiente';
            $total_amount = $_SESSION['totalAmount'];
            $card_number = (isset($_POST['card-num']) && !empty($_POST['card-num'])) ? substr($_POST['card-num'], 12, 16) : null;
            $payment_method = $_POST['payment-option'];
            $delivery_cost = $_GET['delivery'] == 'true' ? 3.5 : 0;
            $iva = round(self::calculateTax($total_amount, $delivery_cost), 2);


            // Con un objeeto order se mandan los datos al DAO para introducirlo en la base de datos
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
            // se informa error para el caso que no se haya podido completar el insert
            if (!$orderId) {
                header('Location: ?controller=order&action=getCheckout&error=insert_order');
            }
            // Aquí se comprueba si existe descuento asociado a un producto para introducirlo en las líneas del pedido
            // o en caso contrario solo asociarlo como un descuento de un pedido ya que existen ambos tipos de
            // descuento
            if (isset($_SESSION['discount']['productId']) && !empty($_SESSION['discount']['productId'])) {
                $productId = $_SESSION['discount']['prodcutId'];
                $discountedPrice = $_SESSION['discount']['amount'];

                $result = OrderDetailsDAO::insertOrderLines($orderId, $promoId, $productId, $discountedPrice);
            } else {
                $result = OrderDetailsDAO::insertOrderLines($orderId);
            }

            // Cuando finaliza el pedido se vacia el carrito, los descuentos y todas las variables de sesión relativas
            // al pedido
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
        // Función privada para el cálcullo del iva
        return ($amount + $delivery_cost) * $tax;
    }

    public function applyPromo()
    {
        // Esta función realiza la aplicación de la promoción por pedido o por producto recibiendo primero el código
        $promo = $_POST['discount-code'];
        $orderAmount = $_POST['orderAmount'];

        // Se evalúa si el usuario está registrado., Solo usuarios registrados pueden aplicar promos.
        if (isset($_SESSION['id'])) {
            // Se comprueba si el descuento existe
            $discount = PromotionDAO::checkPromo($promo);

            if (empty($discount)) {

                header('Location: ?controller=order&action=getCheckout&warning=invalid_code');
            }

            $currentDate = date('Y-m-d');
            // Se valida si la vigencia del descuento está en vigor
            if ($discount->getStart_date() < $currentDate && $currentDate <= $discount->getEnd_date()) {

                // Sevalida si el campo relativo al producto idde la promocion es null, lo quer indica si es 
                // descuento de pedido o de producto
                if ($discount->getProduct_id() == null) {

                    // La  comprobación mira si el descuento está aplicado
                    $result = PromotionDAO::isOrderPromoApplied($discount->getPromotion_id());

                    if (!$result) {
                        // Por último se revisa si el importe es de porcentaje sobre el pedido o sobre importe fijo
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

                    // Para el producto se hace básicamente las mismas comprobaciones salvo que la cantidad porcentual o fija
                    // se descontará sobre el precio del producto sobre el que aplica la promo.
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
        // Este método elimina el descuento en la página de finalizar la compra
        unset($_SESSION['discount']);
        $view = 'app/views/pages/checkout.php';
        include_once('app/views/layouts/main.php');
    }



}