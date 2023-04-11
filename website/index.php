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

        var userid = <?php echo ($_SESSION['userid']); ?>;

        function React(postid, reactiontype)
        {
            if(reactiontype)
            {
                var request = new XMLHttpRequest();
                request.open("GET", "php/make_reaction.php?postid=" + postid + "&ownerid=" + userid + "&type=" + reactiontype);
                request.send();
                var btn_like = document.getElementById("likes-count" + postid);
                request.onreadystatechange = () => 
                {
                    btn_like.innerHTML = request.responseText;
                }
                // like
            }
            else
            {
                var request = new XMLHttpRequest();
                request.open("GET", "php/make_reaction.php?postid=" + postid + "&ownerid=" + userid + "&type=" + reactiontype);
                request.send();
                var btn_deslike = document.getElementById("deslikes-count" + postid);
                request.onreadystatechange = () =>
                {
                    btn_deslike.innerHTML = request.responseText;
                }
                //deslike
            }
        }

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
            $likes = mysqli_num_rows(mysqli_query($db_connection, "SELECT * FROM `reactions` WHERE `type` = '1';"));
            $deslikes = mysqli_num_rows(mysqli_query($db_connection, "SELECT * FROM `reactions` WHERE `type` = '0';"));
            $comments = mysqli_num_rows(mysqli_query($db_connection, "SELECT * FROM `comments` WHERE `postid` = '$postid';"));
            $date = $cache['date'];
            echo "<a href='php/view_post.php?postid=$postid'><div class='posts'>";
            printf("<h4 class='post-owner'>%s %s</h4><h3 class='post-title'>$header</h3>
                <p class='post-content'>$body</p></a>
                <div class='buttons'>
                    <button class='like-button' onclick='React($postid, 1);'>
                        <i class='like-icon'></i>
                        <span class='like-count' id='likes-count$postid'>$likes</span>
                    </button>
                    <button class='dislike-button' onclick='React($postid, 0);'>
                        <i class='dislike-icon'></i>
                        <span class='dislike-count' id='deslikes-count$postid'>$deslikes</span>
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