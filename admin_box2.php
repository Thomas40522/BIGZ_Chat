<?php
    session_start();
    require_once('include/db.php');
    require_once('include/isAdmin.php');
    $sql = "SELECT * FROM suggestions WHERE isRespond = 1";
    // $sql = "SELECT * FROM suggestions";

    $suggestions = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="css/navbar.css">
        <link rel="stylesheet" href="css/title.css">
        <title>Admin Suggestion Box _BIGZ chat</title>
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
            <span id="post">Answered Suggestion box: click here shift to blacklist</span>
        </div>
        <?php
            if($_SESSION['isAdmin'] == 2){
            while($suggestion = mysqli_fetch_assoc($suggestions)){
        ?>
        <div class="content">
            <div id="a_title">
            <div class="container">
                <span id="c_title">Suggestion No. <span><?php echo $suggestion['id'];?></span></span>
                <div class="links">
                    <a class="link" href="<?php echo 'include/admin_box_delete.php?id='.$suggestion['id'];?>">delete</a>
                </div>                 
            </div>
            </div>
            <div id="content">       
                <span id="text_content"><?php echo $suggestion['content']; ?></span><br><br>
                <div id="text_content">Admin Respond: <?php echo $suggestion['respond']; ?></div>
            </div>
            <div id="name">
                <span class="user">posted by: </span><a target="_blank"href="<?php
                        echo 'user_info.php?username=' . $suggestion['username']; 
                    ?>" class="username"><?php 
                        echo $suggestion['username'];
                ?></a>
            </div>
            </div>
            <?php
                }
                mysqli_free_result($suggestions);
            ?>
            
        </div>
        <?php
        }
        ?>

        <script src="js/admin_box2.js"></script>
        <script src="js/navbar.js"></script>
    </body>
</html>