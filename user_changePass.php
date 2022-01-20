<?php
    session_start();
    require_once('include/db.php');
    require_once('include/function.php');
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $username = $_SESSION['username'];
        $password = $_POST['password'];
        $original_password = $_POST['original_password'];
        $confirm_password = $_POST['confirm_password'];
        if(empty($password)||empty($original_password)||empty($confirm_password)){
            echo "<script src='js/warn.js'></script> <script> warning('all the fields are required to be filled') </script>";
        }else if($password!=$confirm_password){
            echo "<script src='js/warn.js'></script> <script> warning('the new password should match the confirm password') </script>";
        }else{
            $sql = "SELECT * FROM users WHERE username = '".$username."' LIMIT 1";
            $result = mysqli_query($conn, $sql);
            $check = mysqli_fetch_assoc($result);
            if($original_password == $check['password']){
                $sql = "UPDATE users SET password = '$password'";
                mysqli_query($conn, $sql);
            }else{
                echo "<script src='js/warn.js'></script> <script> warning('the original password you entered is not correct') </script>";
            }
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="css/navbar.css">
        <link rel="stylesheet" href="css/user.css">
        <title>BIGZ chat</title>
    </head>
    <body>
        <header>
        <nav class="nav_bar">
            <a href="index.php"><span id = "title">BIGZ Chat</span></a>
            <a href="titlepage.php"><span id = "front">首页</span></a>
            <a href=""><span id = "hot">热点</span></a>
            <a href=""><span id = "public"> 公告栏</span></a>
            <a href=""><span id = "box"> 意见箱</span></a>
            <a href=""><span id = "aboutus">About Us</span></a>
            <user>
                <img id = "profilePic" src = "assests/ProfilePic.png", width = "40px", height = "40px", alt = "profile picture">
                <span id = "username"></span>
            </user>
        </nav>
        </header>

        <form action=""method="POST" class="registration">
            <h2 class="topset">Change Your Password</h2>
            <div class="form">
                <label>Original Password*</label>
                <input type="password" name="original_password" id="original_password" required>
            </div>
            <div class="form">
                <label>New Password*</label>
                <input type="password" name="password"id="password" required>
            </div>
            <div class="form">
                <label>Confirm Password*</label>
                <input type="password" name="confirm_password" id="confirm_password" required>
            </div>
            <div class="form">
                    <button>Change Password</button>
            </div>
        </form>

        <script src="js/user_changePass.js"></script>
    </body>
</html>