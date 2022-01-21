<?php
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
        <title>BIGZ chat</title>
    </head>
    <body>
        <header>
        <nav class="nav_bar">
            <a href="../index.php"><span id = "title">BIGZ Chat</span></a>
            <a href="../titlepage.php"><span id = "front">首页</span></a>
            <a href=""><span id = "hot">热点</span></a>
            <a href=""><span id = "public"> 公告栏</span></a>
            <a href=""><span id = "box"> 意见箱</span></a>
            <a href=""><span id = "aboutus">About Us</span></a>
            <user>
                <img id = "profilePic" src = "../assests/ProfilePic.png", width = "40px", height = "40px", alt = "profile picture">
                <span id = "username">User Name</span>
            </user>
        </nav>
        </header>

        <form class="popup" action=""method="POST">
            <input type="submit" name="isReported" id="isReported"/>
            <span class="poptitle">Reason</span>
            <span class="poptxt">Humiliation</span>
            <span class="poptxt">Harassment</span>
            <span class="poptxt">Junk Advertisement</span>
            <span class="poptxt">Incorrect info</span>
        </form>
        <script src="../js/titlepage.js"></script>
        <script src="../js/report.js"></script>
    </body>
</html>