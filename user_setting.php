<?php
    session_start();
    require_once('include/db.php');
    require_once('isLogin.php');
    require_once('include/function.php');

    $username = $_SESSION['username'];
    $sql = "SELECT * FROM users WHERE username ='".$username. "'  LIMIT 1";
    $result = mysqli_query($conn, $sql);
    $info = mysqli_fetch_assoc($result);
    mysqli_free_result($result);

    $warnMessage = $info['warnMessage'];

    if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['status']==2){
        header('Location: user_changePass.php');
    }else if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['status']==1){
        session_destroy();
        header('Location: user_login.php');
    }
    echo "<script src='js/user_setting.js'></script>";
    if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['status']==0){
        if(!empty($_POST['nickname'])){
            $_SESSION['nickname'] = block_content($_POST['nickname']);
        }
        if(!empty($_POST['grade'])){
            $_SESSION['grade'] = $_POST['grade'];
        }
        if(!empty($_POST['gender'])){
            $_SESSION['gender'] = block_content($_POST['gender']);
        }
        if(!empty($_POST['bio'])){
            $_SESSION['bio'] = block_content($_POST['bio']);
        }
        $username = prep_data($_SESSION['username']);
        $nickname = block_content(htmlspecialchars($_SESSION['nickname']));
        $email = prep_data($_SESSION['email']);
        $grade = prep_data($_SESSION['grade']);
        $gender = block_content(prep_data($_SESSION['gender']));
        $bio = block_content(htmlspecialchars($_SESSION['bio']));
        ?>
        <script>
            nickname = "<?php echo $nickname;?>";
            email = "<?php echo $email;?>";
            grade = "<?php echo $grade;?>";
            gender = "<?php echo $gender;?>";
            bio = "<?php echo $bio;?>";
            console.log(nickname);
            changeSetting(nickname, email, grade, gender, bio);
        </script>
        <?php
        if($_POST['status']==0){
            $sql = "UPDATE users SET ";
            $sql .= "username ='". $username. "',";
            $sql .= "nickname ='". $nickname. "',";
            $sql .= "email ='". $email. "',";
            $sql .= "gender ='". $gender. "',";
            $sql .= "grade ='". $grade. "',";
            $sql .= "bio ='". $bio. "'";
            $sql .= "WHERE username = '". $username. "'";
            $sql .= "LIMIT 1";
            mysqli_query($conn, $sql);
            $up = "UPDATE posts SET username = '$nickname' WHERE IDname = '$username'";
            mysqli_query($conn, $up);
        }
    }


?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="css/navbar.css">
        <link rel="stylesheet" href="css/user.css">
        <title>Setting _BIGZ Chat</title>
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
            <h2 class="topset">Profile</h2>
            <?php
                if($info['isBlacklist']==1){
                    echo "<div class='form'>
                        <label><p id='nickName' class='red'>
                        <div class='red'>Warning!!!</div>
                        <div class='red'>$warnMessage</div>
                        <div class='red'>You are now being warned, if you continue such behavior, we would send your account into blacklist and you would not be able to post or reply.</div>
                        <div class='red'>If you have any issue about this please contact us through the suggestion box(“意见箱”)</div>
                        </p></label>
                    </div><br>";
                }else if($info['isBlacklist']==2){
                    echo "<div class='form'>
                        <label><p id='nickName' class='black'>
                        <div class='black'>Blacklist!!!</div>
                        <div class='black'>$warnMessage</div>
                        <div class='black'>You are now being blacklisted, you are now unable to post or reply on our website.</div>
                        <div class='black'>If you have any issue about this, please contact us through the suggestion box(“意见箱”)</div>
                        </p></label>
                    </div><br>";
                }
            ?>
            <div class="form" id="moreLowerSpace">
                <label>User Name: </label><p id="myName"><?php echo $_SESSION['username']; ?></p>
            </div>
            <div class="form">
                <label>Nick Name: </label><p id="nickName"><?php echo $_SESSION['nickname']; ?></p>
                <input type="text" id="nickName" name="nickname" maxlength = 15>
            </div>
            <div class="form">
                <label>Email Address: </label><p id="myEmail"><?php echo $_SESSION['email']; ?></p>
                <?php
                if($info['isBlacklist']!=2){
                    echo "<a class='link' href=
                        'change_email.php';
                    >change</a>";
                }
                ?>
                <a class="link" href="verifying.php"><?php
                    if(!$_SESSION['isVerified']){
                        echo "verify";
                    }
                ?></a>
            </div><br>
            <div></div>
            <div class="form">
                <label>Grade: </label><p id="myGrade"><?php echo $_SESSION['grade']; ?></p>
                <input type="number" id="grade" name="grade">
            </div>
            <div class="form">
                <label>Gender: </label><p id="myGender"><?php echo $_SESSION['gender']; ?></p>
                <input type="text" id="gender" name="gender">
            </div>
            <div class="form">
                <label>Biography: </label><p id="bio"><?php echo $_SESSION['bio']; ?></p>
                <textarea id="bio" name="bio"></textarea>
            </div>
            <div class="form">
                <button>Change Setting</button>
            </div>
            <div id="change_password">
                <button>Change Password</button>
            </div>
            <div id="logout">
                <button>Log out</button>
            </div>
            <input type="hidden" value="0" name="status" id="status"/>
            <script src="js/user_setting.js"></script>
            <script src="js/navbar.js"></script>
        </form>
        
    </body>
</html>