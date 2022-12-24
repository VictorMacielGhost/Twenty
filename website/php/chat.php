<?php
    include "../database/connection.php";
    $chatid = 0; #$_SESSION['chatid'];
    $cache = mysqli_query($db_connection, "SELECT * FROM `messages` WHERE chatid = '$chatid';");
    while($result = mysqli_fetch_array($cache))
    {
        $message = $result['message'];
        $senderid = $result['senderid'];
        echo "<span>$senderid</span> <br>";
        echo "<span>$message</span> <br>";
    }
?>