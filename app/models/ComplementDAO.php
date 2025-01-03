<?php

class ComplementDAO
{
    public static function getAll($filter)
    {
        $con = Database::connect();

        $stmnt = $con->prepare("SELECT * FROM products p JOIN categories c ON p.category_id= c.category_id WHERE category_name LIKE ?");
        $stmnt->bind_param("s", $filter);
        $stmnt->execute();
        $result = $stmnt->get_result();

        $complements = [];

        while ($row = $result->fetch_object('Complement')) {
            $complements[] = $row;
        }
        $con->close();

        return $complements;

    }
}