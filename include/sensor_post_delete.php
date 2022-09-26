<?php
    require_once('db.php');

    $id = $_GET['id'];
    $info = "SELECT uploadImg FROM posts WHERE id = '$id' LIMIT 1";
    $info = mysqli_query($conn, $info);
    $info = mysqli_fetch_assoc($info);

    $sql = "DELETE FROM posts WHERE id = '" .$id ."' LIMIT 1";
    mysqli_query($conn,$sql);
    $newId = "r".$id;
    $table = "DROP TABLE $newId";
    if (mysqli_query($conn,$table)){
        if($info['uploadImg'] == 3){
            $imgUrl = "../assests/".$id.".jpg";
            unlink($imgUrl);
        }
        header("Location: ../sensor_posts.php");
    }else{
        echo "<script src='../js/warn.js'></script> <script> warning('something went wrong'); 
            window.location.href = '../sensor_posts.php';
        </script>";
    }
    
?>