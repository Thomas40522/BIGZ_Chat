<?php
    session_start();
    if(!$_SESSION['isVerified']){
        echo "<script> alert('you need to verify your email to use this function'); 
            window.location.href = 'user_setting.php';
        </script>";
    }
?>
