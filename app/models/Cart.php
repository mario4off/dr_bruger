<?php
class Cart
{
    private $product_id;
    private $product_name;
    private $base_price;
    private $quantity;

    public function addToCart()
    {
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        $productId = $_GET['productId'];

        $product = ProductDAO::getProduct($productId);

        if (!isset($_SESSION['cart'][$productId])) {
            $_SESSION['cart'][$productId] = [
                'product_name' => $product->getProduct_name(),
                'base_price' => $product->getBase_Price(),
                'quantity' => 1
            ];
        } else {
            $_SESSION['cart'][$productId]['quantity']++;
        }

        header('Location: ?controller=product&action=showMenu');
    }
}