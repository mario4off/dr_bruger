<?php
include_once(path_base . 'config/Database.php');
include_once(path_base . 'app/models/Category.php');
class CategoryDAO
{

    public static function getAllCategories()
    {

        $con = Database::connect();

        $stmnt = $con->prepare('SELECT * from categories');

        $stmnt->execute();

        $result = $stmnt->get_result();

        $categories = [];

        while ($row = $result->fetch_object('category')) {

            $categories[] = $row;

        }
        $con->close();

        return $categories;
    }

}