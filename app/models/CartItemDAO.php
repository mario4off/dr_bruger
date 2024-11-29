<?php

class CartItemDAO
{
    public static function getCartItem($id)
    {
        $con = Database::connect();

        $stmnt = $con->prepare("SELECT product_id, main_photo, product_name, base_price FROM products  WHERE product_id = ?");
        $stmnt->bind_param("i", $id);
        $stmnt->execute();
        $result = $stmnt->get_result();

        $product = $result->fetch_object('CartItem');

        $con->close();

        return $product;

    }
    public static function getProductsByOrder($id)
    {
        $con = Database::connect();

        $stmnt = $con->prepare("SELECT order_details.quantity, products.product_id, products.main_photo, products.product_name, products.base_price 
        FROM order_details JOIN products ON  products.product_id = order_details.product_id 
        WHERE order_details.order_id = ? ORDER BY product_id");
        $stmnt->bind_param("i", $id);

        $stmnt->execute();

        $result = $stmnt->get_result();

        $products = [];

        while ($row = $result->fetch_object('CartItem')) {

            $products[] = $row;
        }

        $con->close();

        return $products;
    }
}