<?php
    
    session_start();
    include "../database/connection.php";

    $header = $_POST['header'];
    $body = $_POST['body'];
    $date = time();
    $ownerid = $_SESSION['userid'];

    $header = mysqli_escape_string($db_connection, $header);
    $body = mysqli_escape_string($db_connection, $body);

    $query = mysqli_query($db_connection, "INSERT INTO `posts` (ownerid, header, body, date) VALUES ('$ownerid', '$header', '$body', '$date');");
    if($query)
    {
        echo "<script>
        window.alert('Posted. This Window will close automatic soon.');
        setTimeout('Close()', 2000);
        function Close() {window.close();}
        </script>";
    }
    else
    {
        echo "ERROR TO MAKE POST!!!!!";
    }
?>