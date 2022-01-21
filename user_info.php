<?php
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
        <title>BIGZ chat</title>
    </head>
    <body>
        <header>
        <nav class="nav_bar">
            <a href="index.php"><span id = "title">BIGZ Chat</span></a>
            <a href="titlepage.php"><span id = "front">首页</span></a>
            <a href="developing.php"><span id = "hot">热点</span></a>
            <a href="developing.php"><span id = "public"> 公告栏</span></a>
            <a href="developing.php"><span id = "box"> 意见箱</span></a>
            <a href="developing.php"><span id = "aboutus">About Us</span></a>
            <user>
                <img id = "profilePic" src = "assests/ProfilePic.png", width = "40px", height = "40px", alt = "profile picture">
                <span id = "username"></span>
            </user>
        </nav>
        </header>

        <div class="registration">
            <h2 class="topset">Profile</h2>
            <div class="form">
                <label>Name: </label><p id="nickName"><?php echo $info['nickname']; ?></p>
            </div>
            <div class="form">
                <label>Grade: </label><p id="myGrade"><?php echo $info['grade']; ?></p>
            </div>
            <div class="form">
                <label>Gender: </label><p id="myGender"><?php echo $info['gender']; ?></p>
            </div>
            <div class="form">
                <label>Bio: </label><p id="bio"><?php echo $info['bio']; ?></p>
            </div>
        </form>
            <script src="js/titlepage.js"></script>
        
    </body>
</html>