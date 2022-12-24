<?php

    include "../database/connection.php";
    session_start();
    $message = $_GET['m'];
    $senderid = 1;#$_COOKIE['userid'];
    $chatid = 0; #$_COOKIE['chatid'];
    $timestamp = time();
    mysqli_query($db_connection, "INSERT INTO `messages` (messageid, senderid, chatid, message, timestamp) VALUES (DEFAULT, '$senderid', '$chatid', '$message', '$timestamp');");

    echo "<script>
        window.history.go(-1);
    </script>"

?>