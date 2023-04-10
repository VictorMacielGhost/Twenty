<?php

    session_start();
    include "../database/connection.php";
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $number = $_POST['number'];
    $password = $_POST['password'];

    if(strlen($name) > 24 || strlen($name) < 1) TratarErro(1);
    if(strlen($surname) > 24 || strlen($surname) < 1) TratarErro(2);
    if(strlen($email) > 64 || strlen($email) < 12) TratarErro(3);
    if(strlen($number) > 16) TratarErro(4);
    if(strlen($password) < 1 || strlen($password) > 16) TratarErro(5);

    $hash = password_hash($password, PASSWORD_BCRYPT);

    $_SESSION['name'] = $name;
    $_SESSION['surname'] = $surname;
    $_SESSION['email'] = $email;
    $_SESSION['number'] = $number;

    mysqli_query($db_connection, "INSERT INTO `users` (userid, name, surname, email, phone, password) VALUES (DEFAULT, '$name', '$surname', '$email', '$number', '$hash');");
    header("Location: ../pages/registro-login/confirmEmail.php");

    function TratarErro($errorid)
    {

        echo "
        <script>
            window.alert('ERROR User Cannot be registered. This Error Occured by one malicious modification of your broswer.');
            setTimeout(Redirect(), 10000);
            function Redirect()
            {
                history.go(-1);
            }
        </script>";

        echo "<noscript>ERROR User Cannot be registered. This Error Occured by one malicious modification of your broswer.</noscript>";

        switch($errorid)
        {
            case 1:
            {
                echo "Error: Name too much big or too much small!";
                break;
            }
            case 2:
            {
                echo "Error: Surname Too Much Big Or too Much small!";
                break;
            }
            case 3:
            {
                echo "Error: Email Too Much Big Or too much small!";
                break;
            }
            case 4:
            {
                echo "Error: Number Too Much big!";
                break;   
            }
            case 5:
            {
                echo "Error: Password too much big or too much small!";
                break;
            }
        }

        echo "<noscript><a href='../pages/registro-login/register.html'>Go back to register screen</noscript>";

        die;
    }

?>