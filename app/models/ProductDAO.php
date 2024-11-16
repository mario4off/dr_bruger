<?php

include_once(path_base . 'config/Database.php');

class ProductDAO
{

    public static function getAll()
    {


        $con = Database::connect();

        $stmt = $con->prepare('SELECT * FROM products');

        $stmt->execute();

        $result = $stmt->get_result();

        $products = [];

        while ($row = $result->fetch_object('Product')) {

            $products[] = $row;

        }

        return $products;
    }
    public static function getBestSeller()
    {


        $con = Database::connect();

        $stmt = $con->prepare(
            "SELECT products.product_name, products.base_price, products.main_photo , order_details.product_id
        FROM order_details
        INNER JOIN products ON order_details.product_id = products.product_id
        INNER JOIN categories ON products.category_id = categories.category_id
        WHERE categories.category_name LIKE 'Hamburguesas'
        GROUP BY order_details.product_id
        ORDER BY SUM(order_details.quantity) DESC
        LIMIT 5;"
        );

        $stmt->execute();

        $result = $stmt->get_result();

        $products = [];

        while ($row = $result->fetch_object('Product')) {

            $products[] = $row;

        }

        $con->close();

        return $products;
    }
}