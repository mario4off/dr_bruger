<?php

include_once(path_base . 'app/models/ProductDAO.php');
include_once(path_base . 'app/models/Product.php');



class productController
{


    public function index()
    {


        $products = ProductDAO::getAll();

        $view = path_base . 'app/views/pages/home.php';
        include_once(path_base . 'app/views/layouts/main.php');

    }

}