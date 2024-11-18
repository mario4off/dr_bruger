<?php

class userController
{
    public function showUser()
    {
        $view = path_base . 'app/views/pages/account.php';
        include_once(path_base . 'app/views/layouts/main.php');
    }
}