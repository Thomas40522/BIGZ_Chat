<?php
    require_once('include/db.php');
    require_once('include/function.php');
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $username = prep_data($_POST['name']);
        $password = prep_data($_POST['password']);
        $email = prep_data($_POST['email']);
        $grade = prep_data($_POST['grade']);
        $gender = prep_data($_POST['gender']);

        // $search = "SELECT * FROM users WHERE username=$username";
        // if(mysqli_query($conn, $search)!=null){
        //     die('your username or email address is already taken');
        // }
        $sql = "INSERT INTO users (username, password, email, grade, gender) VALUES('$username','$password','$email','$grade','$gender')";
        mysqli_query($conn, $sql);
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
            <a href="index.php"><span id = "title">BIGZ Chat</span></a>
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

        <div class="registration">
            <h2 class="top">Register Account</h2>
            <p id="field1">Please fill this form to create an account</p>
            <p id="field2">* are required</p>
            <div class="form">
                <label>User Name* (must be under 10 character)</label>
                <input type="text" id="name" required>
            </div>
            <div class="form">
                <label>Email Address*</label>
                <input type="email" id="email" required>
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
                <label>Grade</label>
                <input type="number" id="grade">
            </div>
            <div class="form">
                <label>Gender</label>
                <input type="text" id="gender">
            </div>
            <div class="form">
                <button type="submit">Submit</button>
            </div>
            <p id="last">Already have an account? Click <a href="user_login.php">here</a> to login</p>
        </div>



        <script src="js/user_sign.js"></script>
        <script src="js/ajax-utils.js"></script>
    </body>
</html>