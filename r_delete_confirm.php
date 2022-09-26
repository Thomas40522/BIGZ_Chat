<?php
    session_start();
    require_once('include/db.php');
    require_once('isLogin.php');

    $id = $_GET['replyid'];
    $postId = $_GET['postid'];

    $newId = "r" .$postId;
    $rel = "SELECT * FROM $newId WHERE id = '".$id."' LIMIT 1";
    $reply = mysqli_query($conn, $rel);
    $reply = mysqli_fetch_assoc($reply);


    if($reply['IDname'] == $_SESSION['username']){
        if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['status'] == 1){
            header("Location: include/r_delete.php?username=$username&postid=$postId&replyid=$id");
        }else if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['status'] == 2){
            header("Location: reply.php?id=$postId");
        }
    }else{
        echo "<script src='js/warn.js'></script> <script> warning('this is not your reply, you cannot delete it'); 
            window.location.href = 'reply.php?id=$postId';
        </script>";
    }
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="css/navbar.css">
        <link rel="stylesheet" href="css/delete_confirm.css">
        <title>Delete _BIGZ Chat</title>
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
        <div id = "first">Are you sure to delete this reply?</div>
        <form action="" method="POST" class="registration">
            <span id="yes">
                <button>Yes</button>
            </span>
            <span id="no">
                <button>No</button>
            </span>
            <input type="hidden" value="0" name="status" id="status"/>
            <script src="js/delete_confirm.js"></script>
        </form>
        <script src="js/navbar.js"></script>
        
    </body>
</html>