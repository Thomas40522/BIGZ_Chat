<?php
    session_start();
    require_once('include/db.php');
    require_once('isLogin.php');
    require_once('include/function.php');
    $IDname = $_SESSION['username'];
    if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['status'] == 0){
        $content = prep_data($_POST['comment']);
        $content = nl2br($content);
        
        $sql = "INSERT INTO suggestions (content, username) VALUES ('$content','$IDname')";
        if(!mysqli_query($conn, $sql)){
            die(mysqli_error($conn));
        }
    }
    $sug = "SELECT id FROM suggestions WHERE isRespond = 1 AND username = '$IDname'";
    $suggestions = mysqli_query($conn, $sug);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="css/navbar.css">
        <link rel="stylesheet" href="css/box.css">
        <title>Suggestion Box _BIGZ Chat</title>
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
        <div id="box_main">意见箱</div>
        <body>
            <table>
                <form action="" method="post">
                    <div><textarea id = "input" name=comment rows=10 cols=60 required></textarea></div>
                    <div>
                        <input id="submit" type=submit value="发送意见">
                        <input id="retype" type=reset value="重新填写">
                        <input id="status" name="status" type = "hidden" value = 0>
                    </div>
                </form>
            </table>

            <div id="update">更新</div>
            <?php
                if($suggestions != null){
                    while($suggestion = mysqli_fetch_assoc($suggestions)){
            ?>
            <div id="responds">
                <span>Suggestion No. </span>
                <span><?php echo $suggestion['id']?></span>
                <a href = "<?php echo 'respond.php?id='.$suggestion['id'];?>">View <<</a>
            </div>
            <?php }}?>
        </body>
        <script src="js/navbar.js"></script>
        <script src="js/box.js"></script>
    </body>
    
</html>