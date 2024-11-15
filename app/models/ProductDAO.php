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
}