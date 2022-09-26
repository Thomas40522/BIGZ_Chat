<?php
    session_start();
    if(empty($_SESSION['username'])){
        echo"<script src='js/removeLocal.js'></script>";
        echo "<script src='js/warn.js'></script> <script> warning('please login to use this function'); 
            window.location.href = 'user_login.php';
        </script>";
    }
?>
