<?php
    require_once('include/db.php');
    session_start();
    $id = $_GET['id'];
    $sql = "SELECT * FROM posts WHERE id = '".$id."' LIMIT 1";
    $post = mysqli_query($conn, $sql);
    $post = mysqli_fetch_assoc($post);

    $newId = "r" .$id;
    $rel = "SELECT * FROM $newId ORDER BY id DESC";
    $replies = mysqli_query($conn, $rel);
    
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="css/navbar.css">
        <link rel="stylesheet" href="css/reply.css">
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
        <div class="post">
            <a href = "<?php echo'replying.php?id='.$post['id']?>" id="reply">
            <span id="post">Reply here!!!</span>
            </a>
        </div>
        <div class="content">
            <div class="container">
                <span id="c_title"><?php echo $post['title']; ?></span>
                <div class="links">
                    <a class="link" href="<?php echo 'include/report.php?id='.$post['id'];?>" id="report" target="_blank">report</a>
                    <a class="link" href="<?php echo 'include/delete.php?username='.$post['IDname'].'&postid='.$post['id']; ?>">delete</a>
                </div>                 
            </div>
            <div id="content">       
                <span id="text_content"><?php echo $post['content']; ?></span>
            </div>
            <div id="name">
                <span class="user">posted by: </span><a target="_blank" href="<?php
                    if(!$post['isAnonymous']){
                        echo 'user_info.php?username=' . $post['IDname']; 
                    }else{
                        echo "titlepage.php";
                    }
                    ?>" class="username"><?php 
                    if($post['isAnonymous']){
                        echo "Anonymous";
                    }else{
                        echo $post['username'];
                    }
                ?></a>
            </div>
            
            <?php while($reply = mysqli_fetch_assoc($replies)){ ?>
            <div class="r_links">
                <a class="r_link" href="<?php echo 'include/r_report.php?id='.$newId.'&replyid='.$reply['id'];?>" id="report" target="_blank">report</a>
                <a class="r_link" href="<?php echo 'include/r_delete.php?username='.$reply['IDname'].'&postid='.$id.'&replyid='.$reply['id']; ?>">delete</a>
            </div> 
            <div id="reply_content">       
                <span id="text_content"><?php echo $reply['content']; ?></span>
            </div>
            
            <div id="name">
                <span class="user">replied by: </span><a target="_blank" href="<?php
                    if(!$reply['isAnonymous']){
                        echo 'user_info.php?username=' . $reply['IDname']; 
                    }else{
                        echo 'reply.php?id='.$id;
                    }
                    ?>" class="username"><?php 
                    if($reply['isAnonymous']){
                        echo "Anonymous";
                    }else{
                        echo $reply['username'];
                    }
                ?></a>
            </div>

            <?php
            }
            ?>
        </div>


        <script src="js/titlepage.js"></script>
        <script src="js/reply.js"></script>
    </body>
</html>