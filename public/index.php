<?php

include_once('../config/params.php');
include_once(path_base . 'app/controllers/productController.php');

if (!isset($_GET['controller'])) {

    header('Location: ' . url_base . 'public/index.php?controller=product');

} else {

    echo "Hay controlador en la URL<br><br>";

    $controllerName = $_GET['controller'] . 'Controller';

    if (class_exists($controllerName)) {

        echo "La clase 'controllerProducts' existe<br><br>";

        $controller = new $controllerName;

        if (isset($_GET['action']) && method_exists($controllerName, $_GET['action'])) {

            $action = $_GET['action'];


        } else {

            $action = default_action;

        }

        $controller->$action();

    } else {

        echo "El controlador 'controllerProducts' NO existe";

    }





}