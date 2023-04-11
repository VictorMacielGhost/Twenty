<?php
    session_start();
    if(isset($_SESSION))
    {
        if($_SESSION['logged'] != true)
        {
            header("location: pages/registro-login/login.html");
            die;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css">
    <title>Twenty</title>

    <script>

        function AppendOpenComments(postid)
        {
            window.open("php/view_comments.php?postid=" + postid, "_blank", "width='10%', height='10%'");
        }

        function AppendPostPage()
        {
            window.open("pages/post.html", "_blank", "width='10%' height='10%'");
        }
    </script>

</head>
<body>

    <button class="btn" onclick="AppendPostPage()">What you thinking?</button>

    <?php

        include "database/connection.php";
        include "php/utils.php";

        echo "<main>";

        $query = mysqli_query($db_connection, "SELECT * FROM `posts` ORDER BY `date` DESC");
        while($cache = mysqli_fetch_array($query))
        {
            $postid = $cache['postid'];
            $ownerid = $cache['ownerid'];
            $header = $cache['header'];
            $body = $cache['body'];
            $likes = $cache['likes'];
            $deslikes = $cache['deslikes'];
            $comments = $cache['comments'];
            $date = $cache['date'];
            echo "<a href='php/view_post.php?postid=$postid'><div class='posts'>";
            printf("<h4 class='post-owner'>%s %s</h4><h3 class='post-title'>$header</h3>
                <p class='post-content'>$body</p></a>
                <div class='buttons'>
                    <button class='like-button'>
                        <i class='like-icon'></i>
                        <span class='like-count'>$likes</span>
                    </button>
                    <button class='dislike-button'>
                        <i class='dislike-icon'></i>
                        <span class='dislike-count'>$deslikes</span>
                    </button>
                    <button class='comment-button' onclick='AppendOpenComments($postid);'>
                        <i class='comment-icon'></i>
                        <span class='comment-count'>$comments</span>
                    </button>
                    </div>
        ", GetUserNameById($ownerid, $db_connection), GetUserSurnameById($ownerid, $db_connection)/*, date("F j, Y, g:i a", $date)*/);

            echo "</div>";
        }
        echo "</main>";
    ?>
        
</body>
</html>