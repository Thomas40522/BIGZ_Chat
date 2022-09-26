<?php
    session_start();
    require_once('include/db.php');
    require_once('include/function.php');
    
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $userinfo = prep_data($_POST['userinfo']);
        $password = prep_data($_POST['password']);
        $userinfo = strtolower($userinfo);
        $password = strtolower($password);

        $sql = "SELECT * FROM users WHERE username = '".$userinfo."' OR email = '".$userinfo."' LIMIT 1";
        $result = mysqli_query($conn, $sql);
        $search = mysqli_fetch_assoc($result);
        $checkpassword = $search['password'];
        $checkpassword = strtolower($checkpassword);
        if($checkpassword == $password){
        $_SESSION["username"] = $search['username'];
        $_SESSION["email"] = $search['email'];
        $_SESSION["grade"] = $search['grade'];
        $_SESSION["gender"] = $search['gender'];
        $_SESSION["nickname"] = $search['nickname'];
        $_SESSION["bio"] = $search['bio'];
        $_SESSION["isVerified"] = $search['isVerified'];
        ?>
        <script src="js/user_login.js"></script>
        <script>
            username = "<?php echo $search['username'];?>";
            password = "<?php echo $search['password'];?>";
            login(username, password);
            
        </script>
        <?php
        }else{
            echo "<script> alert('your password does not match or the username or email is incorrect') </script>";
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="css/navbar.css">
        <link rel="stylesheet" href="css/user.css">
        <title>Login _BIGZ Chat</title>
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

        <form action="" method="POST" class="registration">
            <h2 class="toplog">Login</h2>
            <div class="form">
                <label>User Name or Email Address</label>
                <input type="text" id="logname" name="userinfo" required>
            </div>
            <div class="form">
                <label>Password <a href="user_findPassword.php">forget?</a></label>
                <input type="password" id="logpassword" name="password"required>
            </div>
            <div class="form">
                <button type = "submit">Login</button>
            </div>
            <p id="last">Don't have an account? Click <a href="user_sign.php">here</a> to sign up
        </form>
        <script src="js/navbar.js"></script>

    </body>
    <script src="js/user_login.js"></script>
</html>