<?php
class Database
{
    public static function connect($host = '127.0.0.1', $user = 'root', $pass = '', $db = 'drburger_db', $port = 3307)
    {
        // Método con la conexión a la base de datos
        $con = new mysqli($host, $user, $pass, $db, $port);

        if ($con->connect_error) {
            die('Error: No se puede establecer la conexión a la base de datos');
        } else {
            return $con;
        }
    }
}
