<?php
class DessertDAO
{
    public static function getAll($filter)
    {
        $con = Database::connect();

        $stmnt = $con->prepare("SELECT p.product_id, p.product_name, p.main_photo, p.category_id, p.base_price FROM products p JOIN categories c ON p.category_id= c.category_id WHERE c.category_name LIKE ?");
        $stmnt->bind_param("s", $filter);
        $stmnt->execute();
        $result = $stmnt->get_result();

        $desserts = [];

        while ($row = $result->fetch_object('Dessert')) {
            $desserts[] = $row;
        }
        $con->close();

        return $desserts;

    }
}