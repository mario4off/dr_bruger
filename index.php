<?php

include_once('config/params.php');
include_once('app/controllers/productController.php');
include_once('app/controllers/userController.php');
include_once('app/controllers/orderController.php');
include_once('app/controllers/adminController.php');
include_once('app/controllers/apiController.php');

if (!isset($_GET['controller'])) {

    header('Location: ' . url_base . 'index.php?controller=product');

} else {


    $controllerName = $_GET['controller'] . 'Controller';

    if (class_exists($controllerName)) {

        $controller = new $controllerName;


        if (isset($_GET['action']) && method_exists($controllerName, $_GET['action'])) {

            $action = $_GET['action'];

        } else {

            $action = default_action;

        }

        $controller->$action();

    } else {

        header('Location: ' . url_base . 'index.php?controller=product');

    }





}