<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/view_comments.css">
    <title>Comments</title>
</head>
<body>

    <?php
        
        $postid = $_GET['postid'];
        include "../database/connection.php";
        include "../php/utils.php";
        $query = mysqli_query($db_connection, "SELECT * FROM `comments` WHERE postid = '$postid' ORDER BY `date` DESC;");
        while($cache = mysqli_fetch_array($query))
        {
            $postid = $cache['postid'];
            $ownerid = $cache['ownerid'];
            $comment = $cache['comment'];
            $date = $cache['date'];
            printf("<div class='comment'>
            <h2 class='comment-author'>%s</h2>
            <h3 class='comment-header'>%s </h3>
            <p class='comment-date'>%s </p>
            </div>", GetUserNameById($ownerid, $db_connection), $comment, date("F j, Y, g:i a", $date));
        }
    ?>

    <form action="send_comment.php?postid=<?php echo $_GET['postid'] ?>" method="post">
        <textarea name="comment" placeholder="Say something cool!"></textarea>
        <input type='submit'>
    </form>

</body>
</html>