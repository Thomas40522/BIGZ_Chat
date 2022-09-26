<?php
    session_start();
    require_once('include/db.php');
    require_once('isLogin.php');
    require_once('include/isVerified.php');
    require_once('include/function.php');
    $postId = $_GET['postid'];
    $replyId = $_GET['replyid'];

    $get = "SELECT title FROM posts WHERE id = $postId LIMIT 1";
    $title = mysqli_query($conn, $get);
    $title = mysqli_fetch_assoc($title);
    $title = $title['title'];

    $newId = "r".$postId;
    $rel = "SELECT * FROM $newId WHERE id = '".$replyId."' LIMIT 1";
    $reply = mysqli_query($conn, $rel);
    $reply = mysqli_fetch_assoc($reply);

    if($reply['IDname'] != $_SESSION['username'] || $_SESSION['isAdmin'] != 2){
        echo "<script> alert('This is not your reply, please don't intentionally harm our website, thank you'); </script>";
        header("titlepage.php");
    }

    $content = restore($reply['content']);

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $content = prep_data($_POST['content']);
        $content = str_replace(' ','&nbsp',$content);
        $content = block_content($content);
        $content = nl2br($content);

        $isAnonymous = prep_data($_POST['anonymous']);
        
        $nickname = $_SESSION['nickname'];

        $sql = "UPDATE $newId SET content = '$content', isAnonymous = '$isAnonymous', username = '$nickname' WHERE id = '$replyId' LIMIT 1";
        
        if(mysqli_query($conn, $sql)){
            header("Location: reply.php?id=".$postId);
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
        <title>Edit Reply _BIGZ chat</title>
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
        <form class="container" action="" method="post">       
            <div class="n_title">Title</div>
            <div id="n_title"><?php echo $title;?></div>
            <div class="label">Your Reply</div>
            <textarea id= "n_content" name="content" maxlength = 2000 required><?php
                echo $content;
            ?></textarea>

            <div class="chkgroup">
                <span class="label-in">Anonymous</span>
                <input type="hidden" name="anonymous" value="0" />
                <input type="checkbox" name="anonymous" value="1" <?php if ($reply['isAnonymous']){echo "checked";} ?>>
            </div>
            
            <input id="button"type="submit" />
        </form> 


        <script src="js/navbar.js"></script>
        <script src="js/disableClick.js"></script>
    </body>
</html>