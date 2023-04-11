<?php
    include "connection.php";

    mysqli_query($db_connection, "CREATE TABLE IF NOT EXISTS `comments` (
        commentid INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        postid INT,
        ownerid INT,
        comment VARCHAR(128) NOT NULL,
        date INT
    );");

?>