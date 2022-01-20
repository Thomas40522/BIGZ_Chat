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
            <a href="nav_title.html"><span id = "title">BIGZ Chat</span></a>
            <a href="titlepage.html"><span id = "front">首页</span></a>
            <a href=""><span id = "hot">热点</span></a>
            <a href=""><span id = "public"> 公告栏</span></a>
            <a href=""><span id = "box"> 意见箱</span></a>
            <a href=""><span id = "aboutus">About Us</span></a>
            <a href="user_sign.html">
            <user>
                <img id = "profilePic" src = "assests/ProfilePic.png", width = "40px", height = "40px", alt = "profile picture">
                <span id = "username">User Name</span>
            </user></a>
        </nav>
        </header>

        <div class="registration">
            <h2 class="toplog">Login</h2>
            <div class="form">
                <label>User Name</label>
                <input type="text" id="logname" required>
            </div>
            <div class="form">
                <label>Password</label>
                <input type="password" id="logpassword" required>
            </div>
            <div class="form">
                <button>Login</button>
            </div>
            <p id="last">Don't have an account? Click <a href="user_sign.php">here</a> to sign up
        </div>


        <script src="js/ajax-utils.js"></script>
        <script src="js/user_login.js"></script>
    </body>
</html>