<?php
    session_start();
    $code = crypt($_SESSION['email'], $_SESSION['name']);
    if($_POST['code']!= $code)
    {
        echo "ERROR VERIFICATION CODE DOESN'T MATCH!";
        echo "<a href='../pages/confirmEmail.php'>Back</a>";
    }
    else
    {
        include "../database/connection.php";
        $email = $_SESSION['email'];
        mysqli_query($db_connection, "UPDATE `users` SET `email_verified` = '1' WHERE `email` = '$email';");
        echo "Your account was actived successfully!";
        echo "<script>setTimeout('Redirect()', 2000); function Redirect(){window.location.href = '../pages/registro-login/login.html';}</script>";
    }
?>