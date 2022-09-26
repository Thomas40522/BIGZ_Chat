<?php
    require_once('include/db.php');
    require_once('include/function.php');
    session_start();
    $id = $_GET['id'];
    $imgUrl = "assests/".$id.".jpg";
    $sql = "SELECT * FROM posts WHERE id = '".$id."' LIMIT 1";
    $post = mysqli_query($conn, $sql);
    $post = mysqli_fetch_assoc($post);
    $title = restore($post['title']);

    $popularity = $post['popularity'] + 1;
    $inc = "UPDATE posts SET popularity='$popularity' WHERE id = '$id' LIMIT 1";
    mysqli_query($conn, $inc);

    $newId = "r" .$id;
    $rel = "SELECT * FROM $newId ORDER BY id ASC";
    $replies = mysqli_query($conn, $rel);
    if(!$replies){
        header("Location: error_post.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="css/navbar.css">
        <link rel="stylesheet" href="css/reply.css">
        <title><?php 
            if(strlen($title) > 20){
                echo substr($title,0,20)."...";
            }else{
                echo $title;
            }
        ?> _BIGZ Chat</title>
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
        <div id="background-color"></div>

        <div class="post">
            <a href = "<?php echo'replying.php?id='.$post['id'];?>" id="reply">
            <span id="post">Reply here!!!</span>
            </a>
        </div>
        <div class="content">
            <div class="container">
                <span id="c_title"><?php echo $post['title']; ?></span>
                <div class="links">

                    <?php
                        if($post['uploadImg']==3 && $_SESSION['username'] == $post['IDname']){
                    ?>
                    <a class="link" href="<?php echo 'include/image_delete.php?id='.$post['id'];?>" id="report">delete image</a>
                    <?php
                        }
                        if($post['uploadImg']==4 && $_SESSION['username'] == $post['IDname']){
                    ?>
                    <a class="link" href="<?php echo 'include/video_detach.php?id='.$post['id'];?>" id="report">detach video</a>
                    <?php
                        }
                        if($_SESSION['username'] == $post['IDname']){
                    ?>
                    <a class="link" href="<?php echo 'upload.php?id='.$post['id'];?>" id="report">
                        <?php
                            if($post['uploadImg']==1){
                                echo 'upload image or video';
                            }else if($post['uploadImg']==3 || $post['uploadImg'] == 4){
                                echo 'change image or video';
                            }
                        ?>
                    </a>
                    <?php
                        }
                    ?>

                    <a class="link" href="<?php echo 'include/report.php?id='.$post['id'];?>" id="report" target="_blank">report</a>
                    <a class="link" href="<?php echo 'edit_post.php?isTitle=0&postid='.$post['id']; ?>">
                        <?php
                            if($_SESSION['username'] == $post['IDname']){
                                echo 'edit';
                            }
                        ?>
                    </a>
                    <a class="link" href="<?php echo 'delete_confirm.php?username='.$post['IDname'].'&postid='.$post['id']; ?>">
                        <?php
                            if($_SESSION['username'] == $post['IDname']){
                                echo 'delete';
                            }
                        ?>
                    </a>
                </div>                 
            </div>
            <div id="content">       
                <span id="text_content"><?php echo $post['content']; ?></span>
            </div>
            <div id="name">
                <span class="user">posted by: </span><a target="_blank" href="<?php
                    if(!$post['isAnonymous'] || $_SESSION['isAdmin'] == 2 || $_SESSION['isAdmin'] == 1){
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
            <div>
                <?php
                    if($post['uploadImg']==3){
                        echo "<img id = 'image' src ='".$imgUrl."' width = '40%', height = '50%', alt = 'missing image'>";
                    }else if($post['uploadImg'] == 4){
                        $videoUrl = $post['videoUrl'];
                        echo "$videoUrl";
                    }
                ?>
            </div>

            <?php while($reply = mysqli_fetch_assoc($replies)){ ?>
            <div class="r_links">
                <a class="r_link" href="<?php echo 'include/r_report.php?id='.$newId.'&replyid='.$reply['id'].'&original_id='.$id;?>" id="report" target="_blank">report</a>
                <a class="r_link" href="<?php echo 'edit_reply.php?postid='.$id.'&replyid='.$reply['id']; ?>">
                    <?php
                        if($_SESSION['username'] == $reply['IDname']){
                            echo 'edit';
                        }
                    ?>
                </a>
                <a class="r_link" href="<?php echo 'r_delete_confirm.php?postid='.$id.'&replyid='.$reply['id']; ?>">
                    <?php
                        if($_SESSION['username'] == $reply['IDname']){
                            echo 'delete';
                        }
                    ?>
                </a>
            </div> 
            <div id="reply_content">       
                <span id="text_content"><?php echo $reply['content']; ?></span>
            </div>
            
            <div id="name">
                <span class="user">replied by: </span><a target="_blank" href="<?php
                    if(!$reply['isAnonymous'] || $_SESSION['isAdmin'] == 2){
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


        <script src="js/navbar.js"></script>
        <script src="js/reply.js"></script>
    </body>
</html>