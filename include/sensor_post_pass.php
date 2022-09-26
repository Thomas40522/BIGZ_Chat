<?php
    require_once('db.php');

    $id = $_GET['id'];
    $sql="UPDATE posts SET isReported=0 WHERE id='".$id."' LIMIT 1";
    mysqli_query($conn, $sql);
    header("Location: ../sensor_posts.php");
    
?>