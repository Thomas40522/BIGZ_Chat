<?php
    session_start();
    require_once('include/db.php');
    require_once('include/isAdmin.php');
    require_once('include/function.php');
    $username = $_GET['username'];
    $code = $_GET['id'];

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $respond = prep_data($_POST['respond']);
        $sql = "UPDATE users SET warnMessage = '$respond', isBlacklist = $code WHERE username = '$username' LIMIT 1";
        if(!mysqli_query($conn, $sql)){
            echo mysqli_error($conn);
        }
        header("Location: user_info.php?username=$username");
    }


?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="css/navbar.css">
        <link rel="stylesheet" href="css/posting.css">
        <title>Warning Message _BIGZ Chat</title>
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
        <form class="container" action="<?php echo "warning.php?username=".$username."&id=".$code?>" method="post">       
            <div class="n_title">Username</div>
            <div id="n_title"><?php echo $username;?></div>
            <div class="label">Our Warning Message</div>
            <textarea name="respond" required><?php
                if($code == 1){
                    echo "Please stop  !";
                }else if($code == 2){
                    echo "Since you had ,";
                }
            ?></textarea>
            
            <input id="button"type="submit" />
        </form> 


        <script src="js/navbar.js"></script>
    </body>
</html>