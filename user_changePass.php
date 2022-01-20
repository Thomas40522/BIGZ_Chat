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

        <div class="registration">
            <h2 class="topset">Change Your Password</h2>
            <div class="form">
                <label>Original Password*</label>
                <input type="password" id="original_password" required>
            </div>
            <div class="form">
                <label>Password*</label>
                <input type="password" id="password" required>
            </div>
            <div class="form">
                <label>Confirm Password*</label>
                <input type="password" id="confirm_password" required>
            </div>
            <div class="form">
                    <button>Change Password</button>
            </div>
        </div>

        <script src="js/user_changePass.js"></script>

    </body>
</html>