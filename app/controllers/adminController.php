<?php
include_once(path_base . 'config/protection.php');
include_once(path_base . 'config/params.php');

class AdminController
{

    public function showPannel()
    {

        $view = path_base . 'app/views/partials/pannel.php';
        include_once(path_base . 'app/views/layouts/main.php');
    }

    public static function getAllOrders()
    {
        return $result = OrderDAO::findAllOrders();
    }

}