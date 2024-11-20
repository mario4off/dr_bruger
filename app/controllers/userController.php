<?php

include_once(path_base . 'app/models/UserDAO.php');
include_once(path_base . 'app/models/User.php');

class userController
{
    public function showUser()
    {
        $view = path_base . 'app/views/pages/account.php';
        include_once(path_base . 'app/views/layouts/main.php');
    }

    public function createUser($role = 'customer')
    {
        $mail = filter_var($_POST["mail"], FILTER_VALIDATE_EMAIL);

        if (!$mail) {
            header('Location: ?controller=user&action=showUser&warning=mail_format');
        }

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

            $view = path_base . 'app/views/pages/account.php?controller=user&action=showUser&info=user_registered';
            include_once(path_base . 'app/views/layouts/main.php');
        }


    }

    public function userLogin()
    {

        $mail = filter_var($_POST["mail"], FILTER_VALIDATE_EMAIL);

        if (!$mail) {
            header('Location: ?controller=user&action=showUser&warning=mail_format_login');
        }
        $pass = $_POST['pwd'];

        $result = UserDAO::getUserByEmail($mail);

        if (!$result) {
            header('Location: ?controller=user&action=showUser&warning=not_exist_user');
        }

        if (password_verify($pass, $result->getPass())) {

            include_once(path_base . 'config/protecion.php');

            $_SESSION['name'] = $result->getName($name);
            $_SESSION['lastName'] = $result->getLast_name($last_name);
            $_SESSION['address'] = $result->getAddress($address);
            $_SESSION['mail'] = $result->getMail($mail);
            $_SESSION['city'] = $result->getCity($city);
            $_SESSION['cp'] = $result->getCp($cp);
            $_SESSION['phone'] = $result->getPhone($phone);
            $_SESSION['pwd'] = $pass;
            $_SESSION['role'] = $result->getRole($role);

            $view = path_base . 'app/views/pages/account.php';
            include_once(path_base . 'app/views/layouts/main.php');

        } else {
            header('Location: ?controller=user&action=showUser&warning=wrong_password');
        }
    }


    public function editUser($role = 'customer')
    {

        if (UserDAO::destroyUser($_GET['id'])) {
            header('Location: ?controller=user&action=showUser&error=user_not_found');
        } else {

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

            UserDAO::insertUser($user);

            header('Location:?controller=user&action=showUser&info=user_updated');

        }

    }

}