<?php

include_once('app/models/ProductDAO.php');
include_once('app/models/Product.php');
include_once('app/models/CategoryDAO.php');
include_once('app/models/Category.php');
include_once('app/models/CartItemDAO.php');
include_once('app/models/CartItem.php');
include_once('app/models/BurgerDAO.php');
include_once('app/models/Burger.php');
include_once('app/models/ComboDAO.php');
include_once('app/models/Combo.php');
include_once('app/models/ComplementDAO.php');
include_once('app/models/Complement.php');
include_once('app/models/DrinkDAO.php');
include_once('app/models/Drink.php');
include_once('app/models/DessertDAO.php');
include_once('app/models/Dessert.php');
include_once('app/models/SauceDAO.php');
include_once('app/models/Sauce.php');

class productController
{


    public function index()
    {
        $topProducts = ProductDAO::getBestSeller();
        $categories = CategoryDAO::getAllCategories();

        $view = 'app/views/pages/home.php';
        include_once('app/views/layouts/main.php');

    }

    public function showMenu()
    {
        $categories = CategoryDAO::getAllCategories();

        if (!isset($_GET['filter']) || empty($_GET['filter'])) {

            $products = ProductDAO::getAllProducts();
        } else {

            $filter = $_GET['filter'];

            switch ($filter) {
                case 'Hamburguesas':
                    $products = BurgerDAO::getAll($filter);
                    break;
                case 'Complementos':
                    $products = ComplementDAO::getAll($filter);
                    break;
                case 'Bebidas':
                    $products = DrinkDAO::getAll($filter);
                    break;
                case 'Combos':
                    $products = ComboDAO::getAll($filter);
                    break;
                case 'Salsas':
                    $products = SauceDAO::getAll($filter);
                    break;
                case 'Postres':
                    $products = DessertDAO::getAll($filter);
                    break;

                default:
                    header('Location: ?controller=product&action=showMenu&error=category_not_found');

            }
        }
        if ($filter) {
            $suggestedProducts = ProductDAO::getBestSellerByCategory($filter);
            setcookie('suggest', serialize($suggestedProducts), time() + 1000, '/');
        }



        $view = 'app/views/pages/menu.php';
        include_once('app/views/layouts/main.php');
    }

    public function addToCart()
    {
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'];
        }

        $productId = $_GET['productId'];

        $product = CartItemDAO::getCartItem($productId);

        if (!isset($_SESSION['cart'][$productId])) {
            $_SESSION['cart'][$productId] = $product;
            $_SESSION['cart'][$productId]->setQuantity(1);

        } else {
            $_SESSION['cart'][$productId]->setQuantity($_SESSION['cart'][$productId]->getQuantity() + 1);
        }
        $reference = explode('=', ($_SERVER['HTTP_REFERER']));

        if (end($reference) == 'index' || end($reference) == 'logout') {
            header('Location: ?controller=product&action=index#home-anchor');
        } else if ($reference[1] == 'order&action') {
            header('Location: ?controller=order&action=getCheckout#anchor');
        } else {
            header('Location: ?controller=product&action=showMenu&filter=' . $reference[3]);
        }

    }



}