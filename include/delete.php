<?php
    session_start();
    require_once('db.php');

    $id = $_GET['postid'];
    $info = "SELECT * FROM posts WHERE id = '$id' LIMIT 1";
    $info = mysqli_query($conn, $info);
    $info = mysqli_fetch_assoc($info);

    $username = $info['username'];
    if($username != $_SESSION['username']){
        echo "<script> alert('it is not your post, please don't intentionally attack our website') </script>";
        echo "<script> window.location.href = '../titlepage.php'; </script>";

    }

    $sql = "DELETE FROM posts WHERE id = '" .$id ."' LIMIT 1";
    mysqli_query($conn,$sql);
    $newId = "r".$id;
    $table = "DROP TABLE $newId";
    if (mysqli_query($conn,$table)){
        if($info['uploadImg'] == 3){
            $imgUrl = "../assests/".$id.".jpg";
            unlink($imgUrl);
        }
        header("Location: ../titlepage.php");
    }else{
        echo mysqli_error($conn);
    }
    
?>