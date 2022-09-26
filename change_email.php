<?php
    session_start();
    require_once('include/db.php');
    require_once('include/function.php');
    require_once('isLogin.php');

    $IdName = $_SESSION['username'];

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $change = 1;

        $email = $_POST['email'];

        if(!check_email($email)){
            $change = 0;
            echo "<script> alert('only emails with domain of basisinternational-gz and basisinternationalgz are allowed') </script>";
        }

        $result = "SELECT id FROM users WHERE email = '$email' LIMIT 1";
        $search = mysqli_query($conn, $result);
        if(mysqli_num_rows($search)){
            echo "<script> alert('this email address is already taken'); </script>";
            $change = 0;
        }else if($change == 1){
            $_SESSION['email'] = $email;
            $eml="UPDATE users SET email='$email' WHERE username = '$IdName' LIMIT 1";
            mysqli_query($conn, $eml);
            $upd="UPDATE users SET isVerified=0 WHERE username = '$IdName' LIMIT 1";
            mysqli_query($conn, $upd);
            $_SESSION['isVerified'] = False;
        }

        if($change == 1){
            $Vkey = mt_rand(100000,999999);
            $ver="UPDATE users SET Vkey='$Vkey' WHERE username = '$IdName' LIMIT 1";
            mysqli_query($conn, $ver);

            $subject = "Email Verification";
            $message = "<div>BIGZ Chat</div>\n<a href='http://bigzchats.com/verified.php?IdName=$IdName&Vkey=$Vkey'>Verified Email</a >\n<div>click the link or use the following verification code to verify your email</div>\n <div>$Vkey</div>";
            $header = "From: bigzchat\r\n";
            $headers .= "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charnet=UTF-8" . "\r\n";

            if(mail($email,$subject,$message,$headers)){
                echo "<script> alert('verification code sent') </script>";
                echo "<script> window.location.href = 'verifying.php?IdName=$IdName'; </script>";
            }else{
                echo "<script> alert('failed to send the verification code, please try again later') </script>";
            }
            // header("verifying.php?IdName=$IdName");
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="css/navbar.css">
        <link rel="stylesheet" href="css/user.css">
        <title>Change Email _BIGZ Chat</title>
    </head>
    <body>
        <header>
        <nav class="nav_bar">
            <div id = "c_navbar">
                <a href="index.php"><span id = "title">BIGZ Chat</span></a>
                <a href="titlepage.php"><span id = "front">首页</span></a>
                <a href="hotspot.php"><span id = "hot">热点</span></a>
                <a href="public.php"><span id = "public">公告栏</span></a>
                <a href="box.php"><span id = "box">意见箱</span></a>
                <a href="aboutUs.php"><span id = "aboutus">关于我们</span></a>
                <a href="menu.php"><span id = "menu">菜单</span></a>
            </div>
            <div id = "e_navbar">
                <a href="index.php"><span id = "title">BIGZ Chat</span></a>
                <a href="titlepage.php"><span id = "front">Home</span></a>
                <a href="hotspot.php"><span id = "hot">Topic</span></a>
                <a href="public.php"><span id = "public">Billboard</span></a>
                <a href="box.php"><span id = "box">Advice</span></a>
                <a href="aboutUs.php"><span id = "aboutus">About Us</span></a>
                <a href="menu.php"><span id = "menu">Menu</span></a>
            </div>

            <a href=<?php
                if(!empty($_SESSION['username'])){
                    echo "user_setting.php";
                }else{
                    echo "user_login.php";
                }
            ?>>
            <user>
                <img id = "profilePic" src = "assests/ProfilePic.png", width = "40px", height = "40px", alt = "profile picture">
                <span id = "username"><?php 
                    if(!empty($_SESSION['username'])){
                        echo $_SESSION['nickname'];
                    }else{
                        echo "User Name";
                    }
                ?></span>
            </user></a>
            <div id="language"><span id="chinese">中文</span><span id="slash">_____</span><span id="english">English</span></div>
        </nav>
        </header>

        <form action="" method="POST" class="registration">
            <h2 class="toplog">Change your email</h2>
            <div class="body">(Only the basisinternational-gz or basisinternationalgz are allowed)</div>
            <div class="body">you would need to reverify your email address if you change it</div>
            <div class="form">
                <label>Current Email: </label><p id="email"><?php echo $_SESSION['email']; ?></p>
            </div><br>
            <div></div>
            <div class="form">
                <label>New Email: </label>
                <input type="email" id="email" name="email"required>
            </div>
            <div class="form">
                <button type = "submit">Enter</button>
            </div>
        </form>
        <script src="js/navbar.js"></script>

    </body>
</html>