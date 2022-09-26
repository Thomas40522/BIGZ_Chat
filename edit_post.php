<?php
    session_start();
    require_once('include/db.php');
    require_once('isLogin.php');
    require_once('include/isVerified.php');
    require_once('include/function.php');

    $id = $_GET['postid'];
    $isTitle = ($_GET['isTitle'] == 1);
    $sql = "SELECT * FROM posts WHERE id = '".$id."' LIMIT 1";
    $post = mysqli_query($conn, $sql);
    $post = mysqli_fetch_assoc($post);

    if($post['IDname'] != $_SESSION['username'] || $_SESSION['isAdmin'] != 2){
        echo "<script> alert('This is not your post, please don't intentionally harm our website, thank you'); </script>";
        header("titlepage.php");
    }

    $title = restore($post['title']);
    $content = restore($post['content']);

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $title = prep_data($_POST['title']);
        $title = str_replace(' ','&nbsp',$title);
        $title = block_content($title);

        $content = prep_data($_POST['content']);
        $content = str_replace(' ','&nbsp',$content);
        $content = block_content($content);
        $content = nl2br($content);

        $isAnonymous = $_POST['anonymous'];

        $sql = "UPDATE posts SET title = '$title', content = '$content', isAnonymous = '$isAnonymous' WHERE id = '$id' LIMIT 1";
        
        if(mysqli_query($conn, $sql)){
            if($isTitle){
                header("Location: titlepage.php");
            }else{
                header("Location: reply.php?id=$id");
            }
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
        <title>Edit Post _BIGZ chat</title>
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
            <input id="n_title"type="text" name="title" required maxlength = 800 value=<?php
                echo $title;
            ?>>
            
            <div class="label">Content</div>
            <textarea id = "n_content" name="content" required maxlength = 9000><?php
                echo $content;
            ?></textarea>

            <div class="chkgroup">
                <input type="hidden" name="anonymous" value="0" />
                <input type="checkbox" name="anonymous" value="1" <?php if ($post['isAnonymous']){echo "checked";} ?>>
                <span class="label-in">Anonymous</span>
            </div>
            
            <input id="button" type="submit" />
        </form> 


        <script src="js/navbar.js"></script>
        <script src="js/posting_function.js"></script>
    </body>
</html>