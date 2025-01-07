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
        // Es la carga para la home de los productos más vendidos y de los nombres de todas las categorías
        $topProducts = ProductDAO::getBestSeller();
        $categories = CategoryDAO::getAllCategories();

        $view = 'app/views/pages/home.php';
        include_once('app/views/layouts/main.php');

    }

    public function showMenu()
    {
        // Este método carga todas las categorías para la página del menú para mostrar
        $categories = CategoryDAO::getAllCategories();

        // Determina si hay un filtro o no en la url
        if (!isset($_GET['filter']) || empty($_GET['filter'])) {

            $products = ProductDAO::getAllProducts();
        } else {

            $filter = $_GET['filter'];
            //Con un switch lo que se hace es ver qué tipop de producto debemos mostrar 
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
                    header('Location: ?controller=product&action=showMenu#anchormenu');

            }
        }
        if (isset($_GET['filter'])) {
            // La cookie se crea en el momento en el que el filtro existe por un tiempo de un cuarto de hora aproximado
            // con los productos más vendidos de la última categoría más visitada por el usuario
            $suggestedProducts = ProductDAO::getBestSellerByCategory($_GET['filter']);
            setcookie('suggest', serialize($suggestedProducts), time() + 1000, '/');
        }



        $view = 'app/views/pages/menu.php';
        include_once('app/views/layouts/main.php');
    }

    public function addToCart()
    {
        // Este método se encarga de añadir al carrito en variable de sessión como un objeto CartItem a través
        // del id del producto


        $productId = $_GET['productId'];

        $product = CartItemDAO::getCartItem($productId);

        // Se comprueba si la id ya está en el carrito para si no aumentar la cantidad en vez de volver a crear
        // una posición para el mismo id
        if (!isset($_SESSION['cart'][$productId])) {
            $_SESSION['cart'][$productId] = $product;
            $_SESSION['cart'][$productId]->setQuantity(1);

        } else {
            $_SESSION['cart'][$productId]->setQuantity($_SESSION['cart'][$productId]->getQuantity() + 1);
        }

        // Como anteriormente, como se pueden añadir productos desde la home o el menú o la página de finalizar pedido
        // se debe estabalecer a través de la url anterior a qué página debe redirigirse
        $reference = explode('=', ($_SERVER['HTTP_REFERER']));

        if (end($reference) == 'index' || end($reference) == 'logout') {
            header('Location: ?controller=product&action=index#home-anchor');
        } else if ($reference[1] == 'order&action') {
            header('Location: ?controller=order&action=getCheckout#anchor');
        } else {
            header('Location: ?controller=product&action=showMenu&filter=' . $reference[2]);
        }

    }



}