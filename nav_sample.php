<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="css/navbar.css">
        <title>BIGZ chat</title>
    </head>
    <body>
        <header>
        <nav class="nav_bar">
            <a href="nav_title.html"><span id = "title">BIGZ Chat</span></a>
            <a href="titlepage.html"><span id = "front">首页</span></a>
            <a href=""><span id = "hot">热点</span></a>
            <a href=""><span id = "public"> 公告栏</span></a>
            <a href=""><span id = "box"> 意见箱</span></a>
            <a href=""><span id = "aboutus">About Us</span></a>
            <user>
                <img id = "profilePic" src = "assests/ProfilePic.png", width = "40px", height = "40px", alt = "profile picture">
                <span id = "username">User Name</span>
            </user>
        </nav>
        </header>

        <div style="margin-top:100px">
        <?php
        include("data/connect.php");
        echo("1");
        ?>
        </div>

    </body>
</html>