<?php

include_once(path_base . 'app/dao/ProductDAO.php');
include_once(path_base . 'app/models/Product.php');



class productController
{


    public function index()
    {
        echo "Funcionalidad por defecto en método index<br>";
        $view = path_base . 'app/views/home/home.php';
        include_once(path_base . 'app/views/layouts/main.php');

    }

}