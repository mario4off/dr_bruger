<?php

class Database
{
    public static function connect($host = 'localhost', $user = 'root', $pass = '1234', $db = 'dr_burger')
    {
        echo "estoy en la clase base de datos<br><br>";

        $con = new mysqli($host, $user, $pass, $db);

        if ($con->connect_error) {

            echo "Error: No se puede establecer la conexión a la base de datos";

        } else {

            echo "Conexión con la base de datos extablecida!";

        }

        return $con;

    }
}

class ProductDAO
{

    public static function getAll()
    {
        echo "Estoy dentro del DAO";

        $con = Database::connect();

        return $con;
    }
}