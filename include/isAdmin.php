<?php
    session_start();
    if($_SESSION['isAdmin'] != 2 && $_SESSION['isAdmin'] != 1){
        echo "<script src='../js/warn.js'></script> <script> warning('you are not an admin') </script>";
        header("Location: admin.php");
    }
?>