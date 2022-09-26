<?php
    session_start();
    require_once('include/db.php');
    require_once('include/function.php');

    if(!empty($_SESSION['username'])){
        $IdName = $_SESSION['username'];
    }else{
        $IdName = $_GET['IdName'];
    }

    $sql = "SELECT * FROM users WHERE username ='".$IdName. "' LIMIT 1";
    $result = mysqli_query($conn, $sql);
    $info = mysqli_fetch_assoc($result);

    if($info['isVerified']){
        echo "<script> alert('this email is already verified'); </script>";
        $_SESSION['isVerified'] = True;
        echo "<script> window.location.href = 'titlepage.php'; </script>";
    }

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $Vkey = prep_data($_POST['password']);
        $Vkey = strtolower($Vkey);

        if($Vkey == $info['Vkey']){
            $ver="UPDATE users SET isVerified=1 WHERE username = '$IdName' LIMIT 1";
            mysqli_query($conn, $ver);
            if(!empty($_SESSION['username'])){
                $_SESSION['isVerified'] = True;
                header("Location: user_setting.php");
            }else{
                header("Location: user_login.php");
            }
        }else{
            echo "<script> alert('verification code incorrect') </script>";
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="css/navbar.css">
        <link rel="stylesheet" href="css/user.css">
        <title>Verify Email _BIGZ Chat</title>
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
            <h2 class="toplog">Verifying your email</h2>
            <div class="body" id="red">a message has been sent to your email, check the junk email if you didn't see the code</div>
            <div class="body">if you still can't see the code, please inform us through the "Advice" (意见箱)</div>
            <div class="body">please log in if you want to change your email</div>
            <div class="form">
                <label>Email: </label><p id="email"><?php echo $info['email']; ?></p>
            </div><br>
            <div></div>
            <div class="form">
                <label>verification code</label>
                <a class="link" href=<?php
                    echo "include/resend_verification.php?IdName=$IdName";
                ?>>resend</a>
                <input type="text" id="logpassword" name="password"required>
            </div>
            <div class="form">
                <button type = "submit">Enter</button>
            </div>
        </form>

        <script src="js/navbar.js"></script>
    </body>
</html>