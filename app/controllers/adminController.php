<?php
include_once('config/protection.php');
include_once('config/params.php');
include_once('app/models/OrderDAO.php');
include_once('config/Database.php');

class AdminController
{

    public function showPannel()
    {
        require('config/adminProtection.php');
        // Incluye la vista del panel de administración
        $view = 'app/views/pages/pannel.php';
        include_once('app/views/layouts/main.php');
    }


}