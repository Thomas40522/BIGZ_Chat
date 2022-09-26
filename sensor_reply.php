<?php
    session_start();
    require_once('include/db.php');
    require_once('include/isAdmin.php');
    $id = $_GET['id'];

    $imgUrl = "assests/".$id.".jpg";
    $sql = "SELECT * FROM posts WHERE id = '".$id."' LIMIT 1";
    $post = mysqli_query($conn, $sql);
    $post = mysqli_fetch_assoc($post);

    $newId = "r" .$id;
    $rel = "SELECT * FROM $newId WHERE isReported = 1";
    $replies = mysqli_query($conn, $rel);
    
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="css/navbar.css">
        <link rel="stylesheet" href="css/reply.css">
        <title>Admin Reply _BIGZ Chat</title>
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
        <div class="post">
            <span id="post"></span>
        </div>
        <div class="content">
            <div class="container">
                <span id="c_title"><?php echo $post['title']; ?></span>
                <?php
                    if($_SESSION['isAdmin'] == 2){
                ?>
                <div class="links">
                    <a class="link" href="<?php echo 'include/sensor_image_delete.php?id='.$post['id'];?>" id="report">delete image</a>
                </div>       
                <?php
                    }
                ?>
            </div>
            <div id="content">       
                <span id="text_content"><?php echo $post['content']; ?></span>
            </div>
            <div id="name">
                <span class="user">posted by: </span><a target="_blank"href="<?php
                        echo 'user_info.php?username=' . $post['IDname']; 
                    ?>" class="username"><?php 
                        echo $post['username'];
                ?></a>
            </div>
            <div>
                <?php
                    if($post['uploadImg']==3){
                        echo "<img id = 'image' src ='".$imgUrl."' width = '40%', height = '50%', alt = 'missing image'>";
                    }
                ?>
            </div>


            <?php while($reply = mysqli_fetch_assoc($replies)){ ?>
            <div class="r_links">
                <a class="r_link" href="<?php echo 'include/sensor_reply_pass.php?id='.$newId.'&replyid='.$reply['id'].'&original_id='.$id;?>" id="report">pass</a>
                <a class="r_link" href="<?php echo 'edit_reply.php?postid='.$id.'&replyid='.$reply['id']; ?>" target="_blank">edit</a>
                <a class="r_link" href="<?php echo 'include/sensor_reply_delete.php?id='.$newId.'&replyid='.$reply['id'].'&original_id='.$id; ?>">delete</a>
            </div> 
            <div id="reply_content">       
                <span id="text_content"><?php echo $reply['content']; ?></span>
            </div>
            
            <div id="name">
                <span class="user">replied by: </span><a target="_blank" href="<?php
                        echo 'user_info.php?username=' . $reply['IDname']; 
                    ?>" class="username"><?php 
                        echo $reply['username'];
                ?></a>
            </div>

            <?php
            }
            ?>
        </div>


        <script src="js/navbar.js"></script>
        <script src="js/reply.js"></script>
    </body>
</html>