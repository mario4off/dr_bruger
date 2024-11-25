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

    public function showMenu()
    {
        $categories = CategoryDAO::getAllCategories();

        if (!isset($_GET['filter']) || empty($_GET['filter'])) {

            $products = ProductDAO::getAllProducts();
        } else {

            $filter = $_GET['filter'];
            $products = ProductDAO::getProductsByCategory($filter);
        }

        $view = path_base . 'app/views/pages/menu.php';
        include_once(path_base . 'app/views/layouts/main.php');
    }

    public function addToCart()
    {
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        $productId = $_GET['productId'];

        $product = ProductDAO::getProduct($productId);

        if (!isset($_SESSION['cart'][$productId])) {
            $_SESSION['cart'][$productId] = [
                'quantity' => 1
            ];
        } else {
            $_SESSION['cart'][$productId]['quantity']++;
        }
        $reference = explode('=', ($_SERVER['HTTP_REFERER']));

        if (end($reference) == 'index') {
            header('Location: ?controller=product&action=index#home-anchor');
        } else {
            header('Location: ?controller=product&action=showMenu#menu-anchor');
        }

    }



}