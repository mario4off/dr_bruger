<?php
class Database
{
    public static function connect($host = 'localhost:33060', $user = 'root', $pass = '1234', $db = 'dr_burger')
    {
        // Método con la conexión a la base de datos
        $con = new mysqli($host, $user, $pass, $db);

        if ($con->connect_error) {
            die('Error: No se puede establecer la conexión a la base de datos');
        } else {
            return $con;
        }

    }
}
