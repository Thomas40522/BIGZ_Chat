<?php
    session_start();
    require_once('include/db.php');
    require_once('include/function.php');
    require_once('isLogin.php');
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $username = $_SESSION['username'];
        $password = $_POST['password'];
        $original_password = $_POST['original_password'];
        $confirm_password = $_POST['confirm_password'];
        if(empty($password)||empty($original_password)||empty($confirm_password)){
            echo "<script src='js/warn.js'></script> <script> warning('all the fields are required to be filled') </script>";
        }else if($password!=$confirm_password){
            echo "<script src='js/warn.js'></script> <script> warning('the new password should match the confirm password') </script>";
        }else{
            $sql = "SELECT * FROM users WHERE username = '".$username."' LIMIT 1";
            $result = mysqli_query($conn, $sql);
            $check = mysqli_fetch_assoc($result);
            if($original_password == $check['password']){
                $sql = "UPDATE users SET password = '$password' WHERE username = '$username'";
                mysqli_query($conn, $sql);
                ?>
                <script src="js/user_changePass.js"></script>
                <script>
                    password = "<?php echo $password;?>";
                    changePassword(password);
                </script>
                <?php
                // header('Location: user_setting.php');
            }else{
                echo "<script src='js/warn.js'></script> <script> warning('the original password you entered is not correct') </script>";
            }
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="css/navbar.css">
        <link rel="stylesheet" href="css/user.css">
        <title>Change Password _BIGZ Chat</title>
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

        <form action=""method="POST" class="registration">
            <h2 class="topset">Change Your Password</h2>
            <div class="form">
                <label>Original Password*</label>
                <input type="password" name="original_password" id="original_password" required>
            </div>
            <div class="form">
                <label>New Password*</label>
                <input type="password" name="password"id="password" required>
            </div>
            <div class="form">
                <label>Confirm Password*</label>
                <input type="password" name="confirm_password" id="confirm_password" required>
            </div>
            <div class="form">
                    <button>Change Password</button>
            </div>
        </form>

        <script src="js/user_changePass.js"></script>
        <script src="js/navbar.js"></script>
    </body>
</html>