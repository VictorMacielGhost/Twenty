<?php

    include "connection.php";

    mysqli_query($db_connection, "CREATE TABLE IF NOT EXISTS `posts` (
        postid INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        ownerid INT NOT NULL,
        header VARCHAR(64),
        body VARCHAR(256),
        date INT NOT NULL
    );");

?>