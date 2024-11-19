<?php

class UserDAO
{

    public static function getUserEmail($mail)
    {

        $con = Database::connect();

        $stmnt = $con->prepare("SELECT * FROM users WHERE mail LIKE '$mail'");

        $stmnt->execute();

        $result = $stmnt->get_result();

        $userMail = "";

        while ($row = $result->fetch_object('User')) {

            $userMail = $row;

        }

        $con->close();

        return $userMail;

    }

    public static function insertUser($user)
    {
        $con = Database::Connect();
        $stmnt = $con->prepare('INSERT INTO users (name, last_name, address,mail, phone,role,pass,city,cp) VALUES (?,?,?,?,?,?,?,?,?)');
        $stmnt->bind_param(
            "sssssssss",
            $user->getName(),
            $user->getLast_name(),
            $user->getAddress(),
            $user->getMail(),
            $user->getPhone(),
            $user->getRole(),
            $user->getPass(),
            $user->getCity(),
            $user->getCp(),


        );
        $stmnt->execute();
        $con->close();

    }

}