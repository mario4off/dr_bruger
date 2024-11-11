<?php

include_once(path_base . 'dao/ProductDAO.php');
include_once(path_base . '/models/Product.php');



class productController
{


    public function index()
    {
        echo "Funcionalidad por defecto en método index<br>";

        $con = ProductDAO::getAll();

    }

}