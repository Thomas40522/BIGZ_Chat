<?php
    session_start();
    require_once('include/db.php');
    require_once('include/function.php');

    if (!isset($_GET['username'])){
        header("Location: titlepage.php");
    }
    
    $username = $_GET['username'];
    $sql = "SELECT * FROM users WHERE username ='".$username. "'  LIMIT 1";
    $result = mysqli_query($conn, $sql);
    $info = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="css/navbar.css">
        <link rel="stylesheet" href="css/user_info.css">
        <title>Info _BIGZ Chat</title>
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

        <div class="registration">
            <h2 class="topset">Profile</h2>
            <?php
                if($info['isBlacklist']==1){
                    echo "<div class='form'>
                        <label><p id='nickName' class='red'>
                            Warning!!!
                        </p></label>
                    </div>";
                }else if($info['isBlacklist']==2){
                    echo "<div class='form'>
                        <label><p id='nickName' class='black'>
                            Blacklist!!!
                        </p></label>
                    </div>";
                }
            ?>
            <div class="form">
                <label>Name: </label><p id="nickName"><?php echo $info['nickname']; ?></p>
            </div>
            <?php
                if($_SESSION['isAdmin'] == 2 || $_SESSION['isAdmin'] == 1){
            ?>
            <div class = "form"><label><?php
                    echo "Email: ".$info['email'];
            ?><label></div>
            <div class = "form"><label><?php
                    echo "Verification Code: ".$info['Vkey'];
            ?><label></div>
            <?php
                }
            ?>
            <div class="form">
                <label>Grade: </label><p id="myGrade"><?php echo $info['grade']; ?></p>
            </div>
            <div class="form">
                <label>Gender: </label><p id="myGender"><?php echo $info['gender']; ?></p>
            </div>
            <div class="form">
                <label>Biography: </label><p id="bio"><?php echo $info['bio']; ?></p>
            </div>
            <?php
                if($_SESSION['isAdmin'] == 2 || $_SESSION['isAdmin'] == 1){
            ?>
            <div class = "form"><label><a class = "red" href=<?php echo "warning.php?username=$username&id=1"?>><?php
                echo "Warn this user";
            ?></a><label></div>
            <div class = "form"><label><a class="black" href=<?php echo "warning.php?username=$username&id=2"?>><?php
                    echo "Balcklist this user";
            ?></a><label></div>
            <?php
                }
            ?>
        </div>
        
        <script src="js/navbar.js"></script>
    </body>
</html>