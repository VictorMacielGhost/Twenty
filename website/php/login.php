<?php

    session_start();

    include "../database/connection.php";
    $email = $_POST['email'];
    $password = $_POST['password'];

    $cache = mysqli_query($db_connection, "SELECT password FROM `users` WHERE email = '$email';");
    $result = mysqli_fetch_array($cache);
    $hash = $result['password'];
    if(password_verify($password, $hash))
    {
        $remember = $_POST['remember'];
        echo $remember;
        if($remember)
        {
            setcookie('tw_rememberme', 'true', time() + (24 * 8) * 3600);
            setcookie('tw_email', $email, time() + (24 * 8) * 3600);
            setcookie('tw_hash', $result['password'], time() + (24 * 8) * 3600);
        }

        $cache = mysqli_query($db_connection, "SELECT * FROM `users` WHERE email = '$email';");
        $result = mysqli_fetch_array($cache);

        $_SESSION['hash'] = 'undefined';
        $_SESSION['logged'] = true;
        $_SESSION['email'] = $email;
        $_SESSION['name'] = $result['name'];
        $_SESSION['surname'] = $result['surname'];
        $_SESSION['phone'] = $result['phone'];
        $_SESSION['userid'] = $result['userid'];

        header("Location: ../index.php");
    }
    else
    {
        echo "Email ou Senha Incorretos! Tente Novamente! <script>setTimeout('Redirect()', 1500); function Redirect() {window.location.href = '../pages/registro-login/login.html';}</script>";
    }
?>