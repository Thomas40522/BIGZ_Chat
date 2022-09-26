<?php
    session_start();
    require_once('db.php');

    $delete = 1;

    $id = $_GET['id'];
    $info = "SELECT * FROM posts WHERE id = '$id' LIMIT 1";
    $info = mysqli_query($conn, $info);
    $info = mysqli_fetch_assoc($info);
    if($info['IDname'] != $_SESSION['username']){
        echo "<script> alert('this is not your post, you cannot delete the image') </script>";
        $delete = 0;
    }

    if($delete == 1){
        $imgUrl = "../assests/".$id.".jpg";
        unlink($imgUrl);
        $img = "UPDATE posts SET uploadImg = 1 WHERE id= '$id' LIMIT 1";
        mysqli_query($conn, $img);
    }
    header("Location: ../reply.php?id=".$id);
    
?>