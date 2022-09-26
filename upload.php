<?php
    session_start();
    require_once('include/db.php');
    require_once('isLogin.php');
    require_once('include/function.php');
    $id = $_GET['id'];

    $get = "SELECT * FROM posts WHERE id = $id LIMIT 1";
    $title = mysqli_query($conn, $get);
    $title = mysqli_fetch_assoc($title);
    $titleName = $title['title'];

    if($_SESSION['username'] != $title['IDname']){
        echo "<script src='js/warn.js'></script> <script> warning('This is not your post.');
        window.location.href = 'titlepage.php';
        </script>";
    }

    function compress($source, $destination, $quality) {

        $info = getimagesize($source);
    
        if ($info['mime'] == 'image/jpeg') 
            $image = imagecreatefromjpeg($source);
    
        elseif ($info['mime'] == 'image/gif') 
            $image = imagecreatefromgif($source);
    
        elseif ($info['mime'] == 'image/png') 
            $image = imagecreatefrompng($source);
    
        imagejpeg($image, $destination, $quality);
    
        return $destination;
    }

    function cleanUrl($url){
        if(strpos($url, "bilibili") == false){
            return $url;
        }else{
            $cutPos = strpos($url, "//");
            return "<iframe width=\"853\" height=\"505\" src=https:".substr($url, $cutPos);
        }
    }

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if($_POST['vori'] == "image"){
            $target_dir = "assests/";
            $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
            $save_file = $target_dir . $id . '.jpg';
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

            // Check file size
            $size = $_FILES["fileToUpload"]["size"];
            if ($size > 5000000) {
                echo "<script src='js/warn.js'></script> <script> warning('Sorry, your file is too large.') </script>";
                $uploadOk = 0;
            }

            // Allow certain file formats
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
                echo "<script src='js/warn.js'></script> <script> warning('Sorry, only JPG, JPEG & PNG files are allowed.') </script>";
                $uploadOk = 0;
            }        

            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 1){
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $save_file)){
                    if($size>1000000){
                        if($size > 3000000){
                            $quality = 50;
                        }else if($size > 2000000){
                            $quality = 65;
                        }
                        compress($save_file, $save_file, $quality);
                    }                
                    $img = "UPDATE posts SET uploadImg = 3 WHERE id= '$id' LIMIT 1";
                    mysqli_query($conn, $img);
                    header("Location: reply.php?id=".$id);
                } else {
                    echo "<script src='js/warn.js'></script> <script> warning('Sorry, there was an error uploading your file.') </script>";
                }
            }
        }else if($_POST['vori'] == "video"){
            $videoUrl = $_POST['videoUrl'];
            $uploadOk = 1;
            if(strpos($videoUrl, "iframe") == false){
                echo "<script> alert('Sorry, only youtube and bilibili embed links are allowed.') </script>";
                $uploadOk = 0;
            }
            if($uploadOk == 1){

                $videoUrl = cleanUrl($videoUrl);

                $vid = "UPDATE posts SET uploadImg = 4, videoUrl = '$videoUrl' WHERE id= '$id' LIMIT 1";
                if(mysqli_query($conn, $vid)){
                    header("Location: reply.php?id=".$id);
                }else{
                    echo "<script> alert('Failed to attach a video, please try again later') </script>";
                }
            }
        }
    }


?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="css/navbar.css">
        <link rel="stylesheet" href="css/posting.css">
        <link rel="stylesheet" href="css/upload.css">
        <title>Upload Image _BIGZ chat</title>
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
        <form class="container" action="<?php echo "upload.php?id=".$id?>" method="post" enctype="multipart/form-data">       
            <div class="n_title">Title</div>
            <div id="n_title"><?php echo $titleName;?></div>

            <select name = "vori" id="vori">
                <option value="image">Image</option>
                <option value="video">Video</option>
            </select>



            <div id="image">
                <div class="label">Select image to upload:</div>
                <div id = "explanation">the file should be under 5 MB with extension of jpg, jpeg, or png</div>
                <div id="uploadBtn"><input type="file" name="fileToUpload" id="fileToUpload"></div>
            </div>

            <div id="video">
                <div class="label">Please paste the embed link of the video (Youtube or Bilibili):</div>
                <div id = "explanation"><a href="https://rasmussen.libanswers.com/faculty/faq/117678#:~:text=1.,code%20will%20then%20be%20displayed." target="_blank">how</a> to find the embed link (嵌入代码)?</div>
                <input id="n_title"type="text" name="videoUrl" maxlength = 800/>
            </div>

            <div><input id="button"type="submit" /></div>
        </form> 


        <script src="js/navbar.js"></script>
        <script src="js/upload.js"></script>
    </body>
</html>