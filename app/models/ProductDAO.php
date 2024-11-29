<?php



class ProductDAO
{


    public static function getAllProducts()
    {
        $con = Database::connect();

        $stmnt = $con->prepare("SELECT * FROM products");
        $stmnt->execute();
        $result = $stmnt->get_result();

        $products = [];

        while ($row = $result->fetch_object('Product')) {
            $products[] = $row;

        }
        $con->close();


        return $products;
    }

    public static function getProduct($id)
    {
        $con = Database::connect();

        $stmnt = $con->prepare("SELECT * FROM products WHERE product_id = ?");
        $stmnt->bind_param("i", $id);
        $stmnt->execute();
        $result = $stmnt->get_result();

        $product = $result->fetch_object('Product');

        $con->close();

        return $product;

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

    public static function getProductsByCategory($filter)
    {
        $con = Database::connect();

        $stmnt = $con->prepare("SELECT * FROM products WHERE category_id = ?");
        $stmnt->bind_param("i", $filter);
        $stmnt->execute();
        $result = $stmnt->get_result();

        $products = [];

        while ($row = $result->fetch_object('Product')) {
            $products[] = $row;
        }
        $con->close();

        return $products;
    }


}