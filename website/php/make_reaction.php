<?php

    include "../database/connection.php";
    $postid = $_GET['postid'];
    $type = $_GET['type'];
    $ownerid = $_GET['ownerid'];

    $query = mysqli_query($db_connection, "SELECT reactionid FROM `reactions` WHERE `postid` = '$postid' AND `ownerid` = '$ownerid';");
    if(mysqli_num_rows($query))
    {
        $cache = mysqli_fetch_array($query);
        $reactionid = $cache['reactionid'];
        $query = "DELETE FROM `reactions` WHERE `reactionid` = '$reactionid';";
        mysqli_query($db_connection, $query);
    }
    else
    {
        $query = "INSERT INTO `reactions` (ownerid, postid, type) VALUES ('$ownerid', '$postid', '$type');";
        mysqli_query($db_connection, $query);
    }
    if($type == 1) $query = "SELECT * FROM `reactions` WHERE `postid` = '$postid' AND `type` = '1';";
    else $query = "SELECT * FROM `reactions` WHERE `postid` = '$postid' AND `type` = '0';";
    $cache = mysqli_query($db_connection, $query);
    echo (mysqli_num_rows($cache));
?>