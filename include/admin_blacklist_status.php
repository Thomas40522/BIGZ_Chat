<?php
    require_once('db.php');

    $username = $_GET['username'];
    $respond = null;
    $sql = "UPDATE users SET warnMessage = '$respond', isBlacklist = 0 WHERE username = '$username' LIMIT 1";
    mysqli_query($conn,$sql);

    header("Location: ../admin_blacklist.php");
    
?>