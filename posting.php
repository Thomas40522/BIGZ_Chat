<?php
    session_start();
    require_once('include/db.php');
    require_once('include/function.php');
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $title = prep_data($_POST['title']);
        $content = prep_data($_POST['content']);
        $isAnonymous = prep_data($_POST['anonymous']);
        $username = $_SESSION['nickname'];
        $IDname = $_SESSION['username'];
        $isReported = 0;
        $sql = "INSERT INTO posts (title, content, username,isAnonymous,isReported,IDname) VALUES ('$title','$content','$username','$isAnonymous','$isReported','$IDname')";
        mysqli_query($conn, $sql);
        header("Location: titlepage.php");
    }


?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="css/navbar.css">
        <link rel="stylesheet" href="css/posting.css">
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

        <form class="container" action="posting.php" method="post">     

            <div class="n_title">Title</div>
            <input id="n_title"type="text" name="title" required/>
            
            <div class="label">Content</div>
            <textarea name="content" required> </textarea>

            <div class="chkgroup">
                <span class="label-in">Anonymous</span>
                <input type="hidden" name="anonymous" value="0" />
                <input type="checkbox" name="anonymous" value="1" />
            </div>
            
            <input id="button"type="submit" />
        </form> 


        <script src="js/titlepage.js"></script>
    </body>
</html>