<?php
    require_once('db.php');

    $id = $_GET['id'];
    $get = "SELECT inappropriate FROM posts WHERE id = '$id' LIMIT 1";
    $get = mysqli_query($conn, $get);
    $get = mysqli_fetch_assoc($get);
    if($get['inappropriate'] == 0){
        $value = 1;
    }else{
        $value = 0;
    }

    $sql="UPDATE posts SET inappropriate='$value' WHERE id='".$id."' LIMIT 1";
    mysqli_query($conn, $sql);
    header("Location: ../sensor_posts.php");
    
?>