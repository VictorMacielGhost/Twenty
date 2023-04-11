<?php
    include "connection.php";

    mysqli_query($db_connection, "CREATE TABLE IF NOT EXISTS `reactions` (
        reactionid INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        ownerid INT NOT NULL,
        postid INT NOT NULL,
        type TINYINT
    );");
?>