<?php
    session_start();
    require_once('db.php');

    $delete = 1;

    $id = $_GET['id'];

    if($_SESSION['isAdmin'] != 2){
        echo "<script> alert('you are not an admin, you cannot delete the image') </script>";
        $delete = 0;
    }

    if($delete == 1){
        $imgUrl = "../assests/".$id.".jpg";
        unlink($imgUrl);
        $img = "UPDATE posts SET uploadImg = 1 WHERE id= '$id' LIMIT 1";
        mysqli_query($conn, $img);
    }
    header("Location: ../sensor_reply.php?id=".$id);
    
?>