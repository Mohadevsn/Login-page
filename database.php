<?php
    $hostname = "localhost";
    $dbUser = "root";
    $dbPassword ="root";
    $dbName = "login-register";
    $conn = mysqli_connect($hostname, $dbUser, $dbPassword, $dbName);
    

    if(!$conn){
        echo "something is wrong";
        exit;
    }
    echo "Connection successful";
?>