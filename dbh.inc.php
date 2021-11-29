<?php
    $serverName = "localhost";
    $username = "root";
    $password = "";
    $dbName = "uploadimg";

    $conn = mysqli_connect($serverName, $username, $password, $dbName);

    if(!$conn){
        die("Connecting Failed: ".mysqli_connect_error);
    }