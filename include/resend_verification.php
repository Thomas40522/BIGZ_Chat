<?php
    session_start();
    require_once('db.php');

    $IdName = $_GET['IdName'];
    // $Vkey = mt_rand(100000,999999);
    // $ver="UPDATE users SET Vkey='$Vkey' WHERE username = '$IdName' LIMIT 1";
    // mysqli_query($conn, $ver);

    $info = "SELECT * FROM users WHERE username = '$IdName' LIMIT 1";
    $info = mysqli_query($conn, $info);
    $info = mysqli_fetch_assoc($info);

    $Vkey = $info['Vkey'];

    if($info['isVerified']){
        echo "<script src='js/warn.js'></script> <script> warning('this email is already verified') </script>";
        header("Location: titlepage.php");
    }

    $subject = "Email Verification";
    $message = "<div>BIGZ Chat</div>\n<a href='http://bigzchats.com/verified.php?IdName=$IdName&Vkey=$Vkey'>Verified Email</a >\n<div>click the link or use the following verification code to verify your email</div>\n <div>$Vkey</div>";
    $header = "From: bigzchat\r\n";
    $headers .= "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charnet=UTF-8" . "\r\n";

    if(mail($info['email'],$subject,$message,$headers)){
        echo "<script> alert('verification code sent') </script>";
    }else{
        echo "<script> alert('failed to send the verification code, please log in and click resend the code') </script>";
    }
    echo "<script> window.location.href = '../verifying.php?IdName=$IdName'; </script>";
    
?>