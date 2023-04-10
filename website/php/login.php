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
        LoadUserData($db_connection, $email);
    }

    function LoadUserData($connection, $email)
    {
        $remember = $_POST['remember'];

        $cache = mysqli_query($connection, "SELECT * FROM `users` WHERE email = '$email';");
        $result = mysqli_fetch_array($cache);

        if($remember)
        {
            setcookie('tw_rememberme', 'true', time() + (24 * 8) * 3600);
            setcookie('tw_email', $email, time() + (24 * 8) * 3600);
            setcookie('tw_hash', $result['password'], time() + (24 * 8) * 3600);
        }

        $_SESSION['hash'] = 'undefined';
        $_SESSION['logged'] = true;
        $_SESSION['email'] = $email;
        $_SESSION['name'] = $result['name'];
        $_SESSION['surname'] = $result['surname'];
        $_SESSION['phone'] = $result['phone'];
        $_SESSION['userid'] = $result['userid'];

        header("Location: ../index.php");

    }

?>