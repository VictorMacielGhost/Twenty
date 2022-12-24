<?php

    const HOSTNAME = "127.0.0.1";
    const USERNAME = "root";
    const PASSWORD = "";
    const DATABASE = "twenty";
    const PORT = 3306;

    $db_connection = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE, PORT);
    if(mysqli_connect_errno()) printf("An Error has accured with the database. Please, Try again later! (Connection error %d)", mysqli_connect_errno());

?>