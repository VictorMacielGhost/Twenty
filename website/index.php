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
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
    <title>Twenty</title>
    <script src="js/index.js"></script>
    <script>

        var userid = <?php echo ($_SESSION['userid']); ?>;
        var isPostScreenOpened = false;

        function React(postid, reactiontype)
        {
            if(reactiontype)
            {
                var request = new XMLHttpRequest();
                request.open("GET", "php/make_reaction.php?postid=" + postid + "&ownerid=" + userid + "&type=" + reactiontype);
                request.send();
                var btn_like = document.getElementById("icon-like" + postid);
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
                var btn_deslike = document.getElementById("icon-deslike" + postid);
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

        function AppendPost()
        {
            if(!isPostScreenOpened)
            {
                isPostScreenOpened = true;
                var div_post = document.getElementById("OpenPost");
                div_post.style = "display: flex; opacity:1;";
            }
            else
            {
                var div_post = document.getElementById("OpenPost");
                div_post.style = "";
                isPostScreenOpened = false;
            }
            
        }

        document.onkeyup = (e) =>
        {
            if(e.keyCode == 27 && isPostScreenOpened)
            {
                AppendPost();
            }
            else if(document.getElementById("posting").value == "")
            {
                document.getElementById("btn_post").setAttribute("disabled", "true");
            }
            else
            {
                document.getElementById("btn_post").removeAttribute("disabled");
            }
        }
    </script>
</head>
<body>

    <button class="btn-thinking" onclick="AppendPost()">Quer dizer algo?</button>

    <?php

        include "database/connection.php";
        include "php/utils.php";

        echo "<main>";

        $query = mysqli_query($db_connection, "SELECT * FROM `posts` ORDER BY `date` DESC");
        while($cache = mysqli_fetch_array($query))
        {
            $postid = $cache['postid'];
            $ownerid = $cache['ownerid'];
            $body = $cache['body'];
            $likes = mysqli_num_rows(mysqli_query($db_connection, "SELECT * FROM `reactions` WHERE `type` = '1' AND `postid` = '$postid';"));
            $deslikes = mysqli_num_rows(mysqli_query($db_connection, "SELECT * FROM `reactions` WHERE `type` = '0' AND `postid` = '$postid';"));
            $comments = mysqli_num_rows(mysqli_query($db_connection, "SELECT * FROM `comments` WHERE `postid` = '$postid';"));
            $date = $cache['date'];
            
            printf('<div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">%s</h5>
                    <p class="card-text">%s</p>
                    <button onclick="ToggleLike(' . $postid . ')" id="btn-like" ><i class="bi bi-heart" id="icon-like' . $postid . '"></i>%d</button>
                    <button onclick="ToggleDeslike(' . $postid . '); " id="btn-deslike"><i class="bi bi-x-circle" id="icon-deslike' . $postid . '">%d</i></button>
                    <button id="btn-comments"><i class="bi bi-megaphone"></i></button>
                </div>
            </div>
            ', GetUserNameById($ownerid, $db_connection), $body, $likes, $deslikes);
        }
        echo "</main>";
    ?>
    
    <div class="card-post" id="OpenPost">
        <div class="card" style="padding: 10px; border-radius: 20px;">
            <i class="bi bi-x" style="font-size: 2rem;" onclick="AppendPost()" id="btn_close"></i>
            <form action="php/make_post.php" method="Post">
                <textarea name="content" id="posting" cols="60" rows="5" placeholder="Oque você quer dizer?" class="areapost" style="resize: none;"></textarea>
                <input type="submit" value="Publish" class="btn btn-primary" id="btn_post" style="margin-bottom: 10px;" disabled>
            </form>
            <div class="options-post">
                <button class="op-post"><i class="bi bi-images"></i></button>
            </div>
        </div>
        
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>