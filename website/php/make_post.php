<?php
    
    session_start();
    include "../database/connection.php";

    $content = $_POST['content'];
    $date = time();
    $ownerid = $_SESSION['userid'];

    $content = mysqli_escape_string($db_connection, $content);

    $query = mysqli_query($db_connection, "INSERT INTO `posts` (ownerid, body, date) VALUES ('$ownerid', '$content', '$date');");
    header("Location: ../index.php");
?>