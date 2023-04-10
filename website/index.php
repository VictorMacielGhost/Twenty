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
    <title>Twenty</title>

    <script>
        function AppendPostPage()
        {
            window.open("pages/post.html", "_blank", "width='10%' height='10%'");
        }
    </script>

</head>
<body>

    <button onclick="AppendPostPage()">What you thinking?</button>

    <?php

        include "database/connection.php";
        include "php/utils.php";

        echo "<main>";

        $query = mysqli_query($db_connection, "SELECT * FROM `posts`");
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
            printf("<h4>%s %s</h4><h3 class='title'>$header</h3>
                <p class='paragraph'>$body</p>
                <span class='likes'>$likes</span>
                <span class='deslikes'>$deslikes</span>
                <span class='comments'>$comments</span>
                <span class='date'>%s</span>
            ", GetUserNameById($ownerid, $db_connection), GetUserSurnameById($ownerid, $db_connection), date("F j, Y, g:i a", $date));

            echo "</div></a>";
        }
        echo "</main>";
    ?>
        
</body>
</html>