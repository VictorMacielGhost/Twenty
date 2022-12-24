<?php

    include "connection.php";

    mysqli_query($db_connection, "CREATE TABLE IF NOT EXISTS `users`
    (
        userid INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
        name VARCHAR(24) NOT NULL,
        surname VARCHAR(24) NOT NULL,
        email VARCHAR(64) NOT NULL UNIQUE,
        phone VARCHAR(16),
        password VARCHAR(65) NOT NULL
    )");

?>