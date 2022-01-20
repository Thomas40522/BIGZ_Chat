<?php
    session_start();
    require_once('include/db.php');
    require_once('include/function.php');
    
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $userinfo = prep_data($_POST['userinfo']);
        $password = prep_data($_POST['password']);

        $sql = "SELECT * FROM users WHERE username = '".$userinfo."' OR email = '".$userinfo."' LIMIT 1";
        $result = mysqli_query($conn, $sql);
        $search = mysqli_fetch_assoc($result);
        if($search['password'] == $password){
        $_SESSION["username"] = $search['username'];
        $_SESSION["email"] = $search['email'];
        $_SESSION["grade"] = $search['grade'];
        $_SESSION["gender"] = $search['gender'];
        $_SESSION["nickname"] = $search['nickname'];
        $_SESSION["bio"] = $search['bio'];
        ?>
        <script src="js/user_login.js"></script>
        <script>
            username = "<?php echo $search['username'];?>";
            email = "<?php echo $search['email'];?>";
            grade = "<?php echo $search['grade'];?>";
            gender = "<?php echo $search['gender'];?>";
            bio = "<?php echo $search['bio'];?>";
            nickname = "<?php echo $search['nickname'];?>";
            login(username, email, grade, gender, bio, nickname);
            
        </script>
        <?php
        }else{
            echo "<script src='js/warn.js'></script> <script> warning('your password does not match or the username or email is incorrect') </script>";
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="css/navbar.css">
        <link rel="stylesheet" href="css/user.css">
        <title>User sign up</title>
    </head>
    <body>
        <header>
        <nav class="nav_bar">
            <a href="nav_title.php"><span id = "title">BIGZ Chat</span></a>
            <a href="titlepage.php"><span id = "front">首页</span></a>
            <a href=""><span id = "hot">热点</span></a>
            <a href=""><span id = "public"> 公告栏</span></a>
            <a href=""><span id = "box"> 意见箱</span></a>
            <a href=""><span id = "aboutus">About Us</span></a>
            <a href="user_sign.php">
            <user>
                <img id = "profilePic" src = "assests/ProfilePic.png", width = "40px", height = "40px", alt = "profile picture">
                <span id = "username">User Name</span>
            </user></a>
        </nav>
        </header>

        <form action="" method="POST" class="registration">
            <h2 class="toplog">Login</h2>
            <div class="form">
                <label>User Name or Email Address</label>
                <input type="text" id="logname" name="userinfo" required>
            </div>
            <div class="form">
                <label>Password</label>
                <input type="password" id="logpassword" name="password"required>
            </div>
            <div class="form">
                <button type = "submit">Login</button>
            </div>
            <p id="last">Don't have an account? Click <a href="user_sign.php">here</a> to sign up
        </form>


    </body>
</html>