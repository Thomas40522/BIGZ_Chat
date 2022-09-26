<?php
    session_start();
    require_once('include/db.php');
    require_once('include/isAdmin.php');
    $sql = "SELECT * FROM users WHERE isBlacklist = 2 OR isBlacklist = 1";
    $users = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="css/navbar.css">
        <link rel="stylesheet" href="css/title.css">
        <link rel="stylesheet" href="css/user_info.css">
        <title>Admin Blacklist _BIGZ chat</title>
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
            <span id="post">Blacklist: click here shift to posts</span>
        </div>
        <?php
            while($user = mysqli_fetch_assoc($users)){
        ?>
        <div class="content">
            <a target="_blank" href=<?php echo "user_info.php?username=".$user['username'];?> id="a_title">
            <div class="container">
                <span id="c_title"><span><?php echo $user['nickname'];?></span></span>
                <div class="links">
                    <?php
                        if($_SESSION['isAdmin'] == 1){
                    ?>
                    <a class="link" href="<?php echo 'include/admin_blacklist_status.php?username='.$user['username'];?>"><?php
                        if($user['isBlacklist']==1){
                            echo "cancel warning";
                        }else if($user['isBlacklist'] ==2){
                            echo "cancel blacklist";
                        }
                ?></a>
                    <?php
                        }
                    ?>
                </div>                 
            </div>
            </a>
            <div id="content">
                <div>status: <?php
                    if($user['isBlacklist']==1){
                        echo "warning";
                    }else if($user['isBlacklist'] ==2){
                        echo "blacklist";
                    }
                ?></div>
                <span><?php echo "<div>username: ".$user['username']."</div><div>email: ".$user['email']."</div><div>grade: ".$user['grade']."</div><div>gender: ".$user['gender']."</div><div>biography: ".$user['bio']."</div><div>Message: ".$user['warnMessage']."</div>"; ?></span>
            </div>
            <div id="name">
                <span class="user"></span>
            </div>
            <?php
                }
                mysqli_free_result($users);
            ?>
            
        </div>

        <script src="js/admin_blacklist.js"></script>
        <script src="js/navbar.js"></script>
    </body>
</html>