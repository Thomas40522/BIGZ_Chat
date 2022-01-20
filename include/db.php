<?php

    $severname = "127.0.0.1";
    $username = "bigz";
    $password = "110";
    $dbname = "bigzchat";
    $conn = mysqli_connect($severname,$username,$password,$dbname);
    if(!$conn){
        die("connection failed" . mysqli_connect_error());
    }



?>