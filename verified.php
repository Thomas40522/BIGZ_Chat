<?php
    session_start();
    require_once('include/db.php');
    $IdName = $_GET['IdName'];
    $Vkey = $_GET['Vkey'];
    $info = "SELECT * FROM users WHERE username = '$IdName' LIMIT 1";
    $info = mysqli_query($conn, $info);
    $info = mysqli_fetch_assoc($info);
    if(!$info['isVerified']){
        if($info['Vkey'] == $Vkey){
            $ver="UPDATE users SET isVerified=1 WHERE username = '$IdName' LIMIT 1";
            mysqli_query($conn, $ver);
            if(!empty($_SESSION['username'])){
                $_SESSION['isVerified'] = True;
            }
        }
    }
    $info = "SELECT * FROM users WHERE username = '$IdName' LIMIT 1";
    $info = mysqli_query($conn, $info);
    $info = mysqli_fetch_assoc($info);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="css/navbar.css">
        <link rel="stylesheet" href="css/developing.css">
        <title>Verified Email _BIGZ chat</title>
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
        <div id="black">
            <?php
                if($info['isVerified']){
                    echo "Your email is verified";
                }else{
                    echo "There are some issues with your verification, please try again later";
                }
            ?>
        </div>
        <script src="js/navbar.js"></script>
    </body>
</html>