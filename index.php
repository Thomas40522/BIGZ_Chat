<?php
    session_start();
    require_once('include/db.php');
    require_once('include/function.php');
    $isLogin = (!empty($_SESSION['username']));
    
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $userinfo = prep_data($_POST['userinfo']);
        $password = prep_data($_POST['password']);
        $userinfo = strtolower($userinfo);
        $password = strtolower($password);
        $sql = "SELECT * FROM users WHERE username = '$userinfo' LIMIT 1";
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
        header("Location: index.php");
        }else{
            $isLogin = true;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="css/navbar.css">
        <link rel="stylesheet" href="css/index.css">
        <title>BIGZ Chat</title>
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
        <div id = "c_info">
        点击 <a target="_blank" href="https://lab.bigzchats.com">此处</a> 体验BIGZ Lab <br><br>
        欢迎来到 BIGZChat 1.0.4 版本 <br>

        如果您曾经登录过此网站并使用的是Chrome Browser，您可以按 Shift + Command/Control + R 来更新UI设计 <br><br>
        本网站由 Web Development Club 开发，供基础学生分享他们的想法和进行讨论<br><br>
        请点击导航栏中的“首页”，并随意尝试各种功能 <br>
        您可以在“首页”中分享您的帖子并查看和回复其他人的帖子 <br>
        “热点”展示了最热门的帖子 <br>
        “公告栏”会更新即将举行的学校活动 <br>
        “意见箱”允许用户就我们的网站开发以及对学校政策或设施的不满提出疑虑和建议。 我们会尽快回复您 <br>
        <br>
        使用我们的网站时，请遵守以下规则： <br>
        1. 请勿发布或回复非法或不当内容，包括侮辱、骚扰、重复内容、误导性信息、色情或暴露文学 <br> 
        2. 如果看到此类信息请立即举报，我们会尽快删除并严肃处理<br>
        3. 请勿发布任何非法或不当图片，包括血腥、恶心或裸体图片 <br>
        4. 与性或政治敏感内容相关的帖子将被标记，这些帖子不会显示给访客用户和出现在热点中 <br> 
        5. 请对您发送的内容负责，不负责任的帐户将被警告并列入黑名单 <br>
        6. 我们拥有本网站所有规章与条款的最终解释权 <br><br>
        非常感谢 
        </div>

        <div id = "e_info">
        Click <a target="_blank" href="https://lab.bigzchats.com">HERE</a> to explore BIGZ Lab <br><br>
        Welcome to BIGZChat 1.0.4 version. <br>
        If you are using Chrome Browser and had log on to this website before, you can press Shift + Command/Control + R to refresh the UI design <br><br>
        This website is developed by Web Development Club for Basis students to share their thoughts and discussions.<br><br>
        Feel free to try various functions by clicking "Home" in the navigation bar. <br>
        You can share your posts and see others' posts while replying to those in "Home" <br>
        "Topic" shows the trending posts <br>
        "Billboard" updates upcoming school events <br>
        "Advice" allows user to provide concerns and suggestion on both our website development and the grievance on school policies or facilities. We would reply to you soon. <br>
        <br>
        When using our website, please follow the rules below: <br>
        1. DO NOT post or reply illegal or inappropriate contents including humuliation, harassment, repeating content, misleading information, erotic or exposing literature. <br> 
        2. Please immediately report if you see them. We will delete them as soon as possible and penalize the one who sent these posts.<br>
        3. DO NOT post any illegal or inappropriate image including bloody, disgusting or naked pictures. <br>
        4. Posts related to sexual or politically sensitive content would be marked, these posts would not be be displayed to guest user and in Topic <br> 
        5. Please be responsible what you've sent, irresponsible account would be warned and blacklisted <br>
        6. We hold the final right of explanation. <br><br>
        Thank you very much
        </div>

        <script src="js/navbar.js"></script>
        <script src="js/index.js"></script>
    </body>
    <form action="" method="POST">
        <input type="hidden" id="logname" name="userinfo">
        <input type="hidden" id="logpassword" name="password">
        <input type="hidden" id="isLogin" value="<?php echo $isLogin; ?>"name="isLogin">
        <button type = "hidden"></button>
    </form>
    <script src="js/auto_login.js"></script>
    
</html>