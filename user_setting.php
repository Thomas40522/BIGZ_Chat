<?php
    session_start();
    require_once('include/db.php');
    require_once('include/function.php');
    echo "<script src='js/user_setting.js'></script>";
    if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['status']==0){
        if(!empty($_POST['nickname'])){
            $_SESSION['nickname'] = $_POST['nickname'];
        }
        if(!empty($_POST['email'])){
            $_SESSION['email'] = $_POST['email'];
        }
        if(!empty($_POST['grade'])){
            $_SESSION['grade'] = $_POST['grade'];
        }
        if(!empty($_POST['gender'])){
            $_SESSION['gender'] = $_POST['gender'];
        }
        if(!empty($_POST['bio'])){
            $_SESSION['bio'] = $_POST['bio'];
        }
        $username = prep_data($_SESSION['username']);
        $nickname = htmlspecialchars($_SESSION['nickname']);
        $email = prep_data($_SESSION['email']);
        $grade = prep_data($_SESSION['grade']);
        $gender = prep_data($_SESSION['gender']);
        $bio = htmlspecialchars($_SESSION['bio']);

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
        }else if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['status']==2){
            header('Location: user_changePass.php');
        }else if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['status']==1){
            session_destroy();
            header('Location: user_login.php');
        }


?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="css/navbar.css">
        <link rel="stylesheet" href="css/user.css">
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

        <form action="" method="POST" class="registration">
            <h2 class="topset">Profile</h2>
            <div class="form" id="moreLowerSpace">
                <label>User Name: </label><p id="myName"></p>
            </div>
            <div class="form">
                <label>Nick Name: </label><p id="nickName"></p>
                <input type="text" id="nickName" name="nickname">
            </div>
            <div class="form">
                <label>Email Address: </label><p id="myEmail"></p>
                <input type="email" id="email" name="email">
            </div>
            <div class="form">
                <label>Grade: </label><p id="myGrade"></p>
                <input type="number" id="grade" name="grade">
            </div>
            <div class="form">
                <label>Gender: </label><p id="myGender"></p>
                <input type="text" id="gender" name="gender">
            </div>
            <div class="form">
                <label>Bio: </label><p id="bio"></p>
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
        </form>

        
    </body>
</html>