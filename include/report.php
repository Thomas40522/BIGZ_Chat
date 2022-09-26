<?php
    session_start();
    require_once('db.php');
    $id = $_GET['id'];
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $sql="UPDATE posts SET isReported=1 WHERE id='".$id."' LIMIT 1";
        mysqli_query($conn, $sql);
        header("Location: reported.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="../css/navbar.css">
        <link rel="stylesheet" href="../css/report.css">
        <title>Report _BIGZ chat</title>
    </head>
    <body>
        <header>
        <nav class="nav_bar">
            <div id = "c_navbar">
                <a href="../index.php"><span id = "title">BIGZ Chat</span></a>
                <a href="../titlepage.php"><span id = "front">首页</span></a>
                <a href="../hotspot.php"><span id = "hot">热点</span></a>
                <a href="../public.php"><span id = "public">公告栏</span></a>
                <a href="../box.php"><span id = "box">意见箱</span></a>
                <a href="../aboutUs.php"><span id = "aboutus">关于我们</span></a>
                <a href="../menu.php"><span id = "menu">菜单</span></a>
            </div>
            <div id = "e_navbar">
                <a href="../index.php"><span id = "title">BIGZ Chat</span></a>
                <a href="../titlepage.php"><span id = "front">Home</span></a>
                <a href="../hotspot.php"><span id = "hot">Topic</span></a>
                <a href="../public.php"><span id = "public">Billboard</span></a>
                <a href="../box.php"><span id = "box">Advice</span></a>
                <a href="../aboutUs.php"><span id = "aboutus">About Us</span></a>
                <a href="../menu.php"><span id = "menu">Menu</span></a>
            </div>

            <a href=<?php
                if(!empty($_SESSION['username'])){
                    echo "../user_setting.php";
                }else{
                    echo "../user_login.php";
                }
            ?>>
            <user>
                <img id = "profilePic" src = "../assests/ProfilePic.png", width = "40px", height = "40px", alt = "profile picture">
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

        <form class="popup" action=""method="POST">
            <input type="submit" name="isReported" id="isReported"/>
            <span class="poptitle">Reason</span>
            <span class="poptxt">Humiliation</span>
            <span class="poptxt">Harassment</span>
            <span class="poptxt">Junk Advertisement</span>
            <span class="poptxt">Incorrect info</span>
            <span class="poptxt">Inappropriate Content</span>
            <span class="poptxt">Other</span>
        </form>
        <script src="../js/navbar.js"></script>
        <script src="../js/report.js"></script>
    </body>
</html>