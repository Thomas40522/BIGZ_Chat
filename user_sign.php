<?php
    require_once('include/db.php');
    require_once('include/function.php');
    

    if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['isValidated']==1){
        $username = prep_data($_POST['username']);
        $username = strtolower($username);
        $password = prep_data($_POST['password']);
        $password = strtolower($password);
        $email = prep_data($_POST['email']);
        $email = strtolower($email);
        $grade = prep_data($_POST['grade']);
        $gender = prep_data($_POST['gender']);
        $gender = block_content(strtolower($gender));
        $Vkey = mt_rand(100000,999999);
        $bio = "This guy is too lazy to write his bio";
        $nickname = $username;

        if(!preg_match('/^[a-zA-Z0-9_.]+$/', $username)){
            echo "<script> alert('username can only contain letters, numbers, and underscores') </script>";
            $_POST['isValidated'] = 0;
        }

        if(empty($grade)){
            $grade = 0;
        }
        if(empty($gender)){
            $gender = "unknown";
        }
        $result = "SELECT id FROM users WHERE username = '".$username."' OR email = '".$email."'";
        $search = mysqli_query($conn, $result);
        if(mysqli_num_rows($search)){
            $_POST['isValidated'] = 0;
            echo "<script> alert('your username or email is already taken') </script>";
        }
        if(!check_email($email)){
            $_POST['isValidated'] = 0;
            echo "<script> alert('only emails with domain of basisinternational-gz and basisinternationalgz are allowed') </script>";
        }
        if($_POST['isValidated'] == 1){
            $sql = "INSERT INTO users (username, password, email, grade, gender,bio,nickname, Vkey) VALUES ('$username','$password','$email','$grade','$gender','$bio','$nickname','$Vkey')";

            $subject = "Email Verification";
            $message = "<div>BIGZ Chat</div>\n<a href='http://bigzchats.com/verified.php?IdName=$username&Vkey=$Vkey'>Verified Email</a >\n<div>click the link or use the following verification code to verify your email</div>\n <div>$Vkey</div>";
            $header = "From: bigzchat\r\n";
            $headers .= "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charnet=UTF-8" . "\r\n";

            if(mail($email,$subject,$message,$headers)){
                echo "<script>console.log('email sent')<script>";
            }else{
                echo "<script src='js/warn.js'></script> <script> warning('failed to send the verification code, please log in and click resend the code') </script>";
            }

            if(mysqli_query($conn, $sql)){
                header("Location: verifying.php?IdName=$username");
            }else{
                // $error = mysqli_error($conn);
                // echo "<script> alert('$error') </script>";
                echo "<script> alert('failed to create account, please try again') </script>";
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
        <link rel="stylesheet" href="css/user_sign.css">
        <title>Sign Up _BIGZ Chat</title>
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

        <form action = "" method="POST" class="registration">
            <h2 class="top">Register Account</h2>
            <p id="field1">Please fill this form to create an account</p>
            <p id="field2">* are required</p>
            <div class="form">
                <label class = "displayBlock">User Name* (must be under 15 character, only letters, numbers, and underscores)</label>
                <input type="text" id="name" name = "username" required maxlength = 15>
                <span id="changeNameColor">NOT Satisfied</span>
            </div>
            <div class="form">
                <label class = "displayBlock">Email Address* (Only the basisinternational-gz or basisinternationalgz are allowed)</label>
                <input type="email" id="email" name = "email" required>
                <span id="changeEmailColor">NOT Satisfied</span>
            </div>
            <div class="form">
                <label class = "displayBlock">Password* (Only letters, numbers, and underscores)</label>
                <input type="password" id="password" name = "password" required>
                <span id="changePasswordColor">NOT Satisfied</span>
            </div>
            <div class="form">
                <label class = "displayBlock">Confirm Password*</label>
                <input type="password" id="confirm_password" name = "confirm_password" required>
                <span id="changeConPasswordColor">NOT Satisfied</span>
            </div>
            <div class="form">
                <label>Grade</label>
                <input type="number" id="grade" name = "grade">
            </div>
            <div class="form">
                <label>Gender</label>
                <input type="text" id="gender" name = "gender">
            </div>
            <div class="form">
                <button type="submit">Submit</button>
            </div>
            <p id="last">Already have an account? Click <a href="user_login.php">here</a> to login</p>
            <input type = "hidden" name="isValidated" id="isValidated" value="0">
            <script src="js/user_sign.js"></script>
        </form>



        <script src="js/ajax-utils.js"></script>
        <!-- <script src="js/disableClick.js"></script> -->
        <script src="js/navbar.js"></script>
    </body>
</html>