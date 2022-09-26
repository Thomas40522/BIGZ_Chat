<?php
    session_start();

    $username = $_SESSION['username'];
    $sql = "SELECT isBlacklist FROM users WHERE username ='$username' LIMIT 1";
    $info = mysqli_query($conn, $sql);
    $info = mysqli_fetch_assoc($info);
    if($info['isBlacklist']==2){
        echo "<script> alert('you are blacklisted and blocked from using this function'); 
            window.location.href = 'titlepage.php';
        </script>";
    }
?>
