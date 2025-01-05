<?php

class LogDAO
{

    public static function insertLog($log)
    {
        $con = Database::connect();

        $stmnt = $con->prepare("INSERT INTO logs (user_id, action, altered_table, object_id) VALUES (?,?,?,?)");
        $stmnt->bind_param(
            "issi",
            $log->getUser_id(),
            $log->getAction(),
            $log->getAltered_table(),
            $log->getObject_id(),

        );

        $stmnt->execute();

        $con->close();

        return 'ok';
    }

    public static function getlogs()
    {
        $con = Database::connect();

        $stmnt = $con->prepare("SELECT * FROM logs ORDER BY date_time DESC");
        $stmnt->execute();
        $result = $stmnt->get_result();

        $orders = [];

        while ($row = $result->fetch_assoc()) {

            $orders[] = $row;

        }
        $con->close();

        return $orders;
    }
}