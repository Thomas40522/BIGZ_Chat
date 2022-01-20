<?php
    require_once('include/db.php');
    session_start();
    $sql = "SELECT * FROM posts";
    $posts =mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="css/navbar.css">
        <link rel="stylesheet" href="css/title.css">
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
            <span id="post">Post your own here!!!</span>
        </div>
        <?php
            while($post = mysqli_fetch_assoc($posts)){
        ?>
        <div class="content">
            <div class="container">
                <span id="c_title"><?php echo $post['title']; ?></span>
                <div class="links">
                    <a class="link" href="">report</a>
                    <a class="link" href="<?php echo 'include/delete.php?username='.$post['IDname'].'&postid='.$post['id']; ?>">delete</a>
                </div>                 
            </div>
            <div id="content">       
                <span id="text_content"><?php echo $post['content']; ?></span>
            </div>
            <div id="name">
                <span class="user">posted by: </span><a href="<?php
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
            <?php
                }
                mysqli_free_result($posts);
            ?>
        </div>


        <script src="js/titlepage.js"></script>
    </body>
</html>