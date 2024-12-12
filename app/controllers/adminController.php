<?php
include_once(path_base . 'config/protection.php');
include_once(path_base . 'config/params.php');
include_once(path_base . 'app/models/OrderDAO.php');
include_once(path_base . 'config/Database.php');

class AdminController
{

    public function showPannel()
    {
        $view = path_base . 'app/views/pages/pannel.php';
        include_once(path_base . 'app/views/layouts/main.php');
    }



}