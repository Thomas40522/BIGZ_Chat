<?php
    session_start();
    require_once('include/db.php');
    require_once('isLogin.php');
    require_once('include/function.php');
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $title = prep_data($_POST['title']);
        $content = prep_data($_POST['content']);
        $isAnonymous = prep_data($_POST['anonymous']);
        $username = $_SESSION['nickname'];
        $IDname = $_SESSION['username'];
        $isReported = 0;

        $data = "SELECT MAX(viewOrder) AS largestOrder FROM posts";
        $result = mysqli_query($conn, $data);
        $result = mysqli_fetch_assoc($result);
        $viewOrder = ++$result['largestOrder'];

        $sql = "INSERT INTO posts (title, content, username,isAnonymous,isReported,IDname,viewOrder) VALUES ('$title','$content','$username','$isAnonymous','$isReported','$IDname','$viewOrder')";
        mysqli_query($conn, $sql);

        $pick = "SELECT id AS identification FROM posts WHERE title = '$title' LIMIT 1";
        $result = mysqli_query($conn, $pick);
        $id = mysqli_fetch_assoc($result);
        $id = $id['identification'];
        $id = "r" . $id;

        $table="CREATE TABLE $id(
            id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
            content VARCHAR(2000) NOT NULL,
            username VARCHAR(20) NOT NULL,
            isAnonymous BOOLEAN NOT NULL,
            isReported BOOLEAN NOT NULL,
            IDname VARCHAR(20) NOT NULL
            )";
        if(mysqli_query($conn, $table)){
            echo "<script>console.log('table created')</script>";
            header("Location: titlepage.php");
        }else{
            echo mysqli_error($conn);
        }
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