<?php
    session_start();
    include "../database/connection.php";
    $postid = $_GET['postid'];
    $comment = $_POST['comment'];
    $ownerid = $_SESSION['userid'];
    $date = time();
    mysqli_query($db_connection, "INSERT INTO `comments` (postid, comment, ownerid, date) VALUES ('$postid', '$comment', '$ownerid', '$date')");
    echo "<script>window.close()</script>";

?>