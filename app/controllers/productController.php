<?php

include_once(path_base . 'app/models/ProductDAO.php');
include_once(path_base . 'app/models/Product.php');
include_once(path_base . 'app/models/CategoryDAO.php');
include_once(path_base . 'app/models/Category.php');


class productController
{


    public function index()
    {


        $topProducts = ProductDAO::getBestSeller();
        $categories = CategoryDAO::getAllCategories();

        $view = path_base . 'app/views/pages/home.php';
        include_once(path_base . 'app/views/layouts/main.php');

    }

}