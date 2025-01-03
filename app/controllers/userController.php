<?php
include_once('config/protection.php');
include_once('app/models/UserDAO.php');
include_once('app/models/User.php');
include_once('app/models/OrderHistoryDAO.php');
include_once('app/models/OrderHistory.php');
include_once('config/params.php');

class userController
{
    public function showUser()
    {
        $section = isset($_GET['section']) ? $_GET['section'] : 'profile';

        if ($section == 'orders') {
            $user_id = $_SESSION['id'];
            $orderHistory = OrderHistoryDAO::getOrderHistoryByUser($user_id);

            $productsInOrder = [];

            foreach ($orderHistory as $order) {

            }
        }
        $view = 'app/views/pages/account.php';
        include_once('app/views/layouts/main.php');
    }

    public function createUser($role = 'customer')
    {
        $mail = filter_var($_POST["mail"], FILTER_VALIDATE_EMAIL);

        if (!$mail) {
            header('Location: ?controller=user&action=showUser&warning=mail_format');
        } else if ($_POST['pwd'] != $_POST['pwd-r']) {
            header('Location: ?controller=user&action=showUser&warning=missmatch_password');
        } else {
            if (UserDAO::getUserByEmail($mail)) {
                header('Location: ?controller=user&action=showUser&warning=user_exist');
            } else {
                $name = $_POST['name'];
                $last_name = $_POST['lastname'];
                $address = $_POST['address'];
                $city = $_POST['city'];
                $cp = $_POST['cp'];
                $phone = $_POST['phone'];
                $pass = password_hash($_POST['pwd'], PASSWORD_DEFAULT);

                $user = new User();

                $user->setName($name);
                $user->setLast_name($last_name);
                $user->setAddress($address);
                $user->setMail($mail);
                $user->setCity($city);
                $user->setCp($cp);
                $user->setPhone($phone);
                $user->setPass($pass);
                $user->setRole($role);

                UserDAO::insertUser($user);

                header('Location: ?controller=user&action=showUser&success=user_created');
            }

        }



    }

    public function userLogin()
    {

        $mail = filter_var($_POST["mail"], FILTER_VALIDATE_EMAIL);

        if (!$mail) {
            header('Location: ?controller=user&action=showUser&warning=mail_format');
        }
        $pass = $_POST['pwd'];

        $result = UserDAO::getUserByEmail($mail);

        if (!$result) {
            header('Location: ?controller=user&action=showUser&warning=not_exist_user');
        }

        if (password_verify($pass, $result->getPass())) {


            $_SESSION['name'] = $result->getName();
            $_SESSION['lastName'] = $result->getLast_name();
            $_SESSION['address'] = $result->getAddress();
            $_SESSION['mail'] = $result->getMail();
            $_SESSION['city'] = $result->getCity();
            $_SESSION['cp'] = $result->getCp();
            $_SESSION['phone'] = $result->getPhone();
            $_SESSION['pwd'] = $pass;
            $_SESSION['role'] = $result->getRole();
            $_SESSION['id'] = $result->getUser_id();


            $reference = explode('=', ($_SERVER['HTTP_REFERER']));
            $method = explode('&', $reference[2]);

            if ($method[0] == 'getCheckout') {
                $view = 'app/views/pages/checkout.php';
                include_once('app/views/layouts/main.php');
            } else {
                $view = 'app/views/pages/account.php';
                include_once('app/views/layouts/main.php');
            }

        } else {
            header('Location: ?controller=user&action=showUser&warning=wrong_password');
        }
    }


    public function editUser($role = 'customer')
    {

        $mail = filter_var($_POST["mail"], FILTER_VALIDATE_EMAIL);

        if (!$mail) {
            header('Location: ?controller=user&action=showUser&warning=mail_format');
        }
        $name = $_POST['name'];
        $last_name = $_POST['lastname'];
        $address = $_POST['address'];
        $city = $_POST['city'];
        $cp = $_POST['cp'];
        $phone = $_POST['phone'];
        $pass = password_hash($_POST['pwd'], PASSWORD_DEFAULT);

        $user = new User();

        $user->setName($name);
        $user->setLast_name($last_name);
        $user->setAddress($address);
        $user->setMail($mail);
        $user->setCity($city);
        $user->setCp($cp);
        $user->setPhone($phone);
        $user->setPass($pass);
        $user->setRole($role);
        $user->setUser_id($_SESSION['id']);

        UserDAO::updateUser($user);

        $_SESSION['name'] = $user->getName();
        $_SESSION['lastName'] = $user->getLast_name();
        $_SESSION['address'] = $user->getAddress();
        $_SESSION['cp'] = $user->getCp();
        $_SESSION['city'] = $user->getCity();
        $_SESSION['phone'] = $user->getPhone();
        $_SESSION['role'] = $user->getRole();
        $_SESSION['mail'] = $user->getMail();
        $_SESSION['pwd'] = $_POST['pwd'];

        $_SESSION['success'] = 'Los datos se han modificado con éxito';

        $view = 'app/views/pages/account.php';
        include_once('app/views/layouts/main.php');

    }


    public function logout()
    {
        session_destroy();

        header('Location:  ?controller=product&action=index');
    }



}