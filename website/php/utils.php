<?php

    function GetUserNameById(int $userid, $db_connection)
    {
        $query = mysqli_query($db_connection, "SELECT `name` FROM `users` WHERE `userid` = '$userid';");
        $cache = mysqli_fetch_array($query);
        $name = $cache['name'];
        return $name;
    }

    function GetUserSurnameById(int $userid, $db_connection)
    {
        $query = mysqli_query($db_connection, "SELECT `surname` FROM `users` WHERE `userid` = '$userid';");
        $cache = mysqli_fetch_array($query);
        $surname = $cache['surname'];
        return $surname;
    }

?>