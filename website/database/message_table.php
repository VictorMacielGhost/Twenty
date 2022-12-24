<?php

    include "connection.php";

    mysqli_query($db_connection, "CREATE TABLE IF NOT EXISTS `messages`
    (
        messageid INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        senderid INT NOT NULL,
        chatid INT,
        message VARCHAR(256),
        timestamp INT NOT NULL
    );");

?>