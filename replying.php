<?php
    session_start();
    require_once('include/db.php');
    require_once('isLogin.php');
    require_once('include/isVerified.php');
    require_once('include/isBlacklist.php');
    require_once('include/function.php');
    $id = $_GET['id'];

    $get = "SELECT title FROM posts WHERE id = $id LIMIT 1";
    $title = mysqli_query($conn, $get);
    $title = mysqli_fetch_assoc($title);
    $title = $title['title'];

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $content = prep_data($_POST['content']);
        $content = str_replace(' ','&nbsp',$content);
        $content = block_content($content);
        $content = nl2br($content);
        $isAnonymous = prep_data($_POST['anonymous']);
        $username = $_SESSION['nickname'];
        $IDname = $_SESSION['username'];
        $isReported = 0;

        if(empty($username)||empty($IDname)){
            die('missing user');
        }

        $data = "SELECT MAX(viewOrder) AS largestOrder FROM posts";
        $result = mysqli_query($conn, $data);
        $result = mysqli_fetch_assoc($result);
        $viewOrder = ++$result['largestOrder'];

        $newId = "r" . $id;
        $sql = "INSERT INTO $newId (content, username, isAnonymous,isReported,IDname) VALUES ('$content','$username','$isAnonymous','$isReported','$IDname')";
        if(mysqli_query($conn, $sql)){
            // echo"<script> console.log('success'); </script>";
        }

        $update = "UPDATE posts SET viewOrder='$viewOrder' WHERE id = '$id' LIMIT 1";
        mysqli_query($conn, $update);

        $pos = "SELECT popularity FROM posts WHERE id = '".$id."' LIMIT 1";
        $post = mysqli_query($conn, $pos);
        $post = mysqli_fetch_assoc($post);
        $popularity = $post['popularity'] + 10;
        $inc = "UPDATE posts SET popularity='$popularity' WHERE id = '$id' LIMIT 1";
        mysqli_query($conn, $inc);
        header("Location: reply.php?id=".$id);
    }


?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="css/navbar.css">
        <link rel="stylesheet" href="css/posting.css">
        <title>Reply BIGZ Chat</title>
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
        <form class="container" action="<?php echo "replying.php?id=".$id?>" method="post">       
            <div class="n_title">Title</div>
            <div id="n_title"><?php echo $title;?></div>
            <div class="label">Your Reply</div>
            <textarea id= "n_content" name="content" maxlength = 2000 required></textarea>

            <div class="chkgroup">
                <span class="label-in">Anonymous</span>
                <input type="hidden" name="anonymous" value="0" />
                <input type="checkbox" name="anonymous" value="1" />
            </div>
            
            <input id="button"type="submit" />
        </form> 


        <script src="js/navbar.js"></script>
        <script src="js/disableClick.js"></script>
    </body>
</html>