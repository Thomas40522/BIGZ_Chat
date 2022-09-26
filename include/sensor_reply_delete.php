<?php
    require_once('db.php');

    $id = $_GET['id'];
    $replyid = $_GET['replyid'];
    $original_id = $_GET['original_id'];
    $sql = "DELETE FROM $id WHERE id = '" .$replyid ."' LIMIT 1";
    mysqli_query($conn,$sql);

    $pos = "SELECT popularity FROM posts WHERE id = '".$original_id."' LIMIT 1";
    $post = mysqli_query($conn, $pos);
    $post = mysqli_fetch_assoc($post);
    $popularity = $post['popularity'] - 10;
    $inc = "UPDATE posts SET popularity='$popularity' WHERE id = '$original_id' LIMIT 1";
    mysqli_query($conn, $inc);

    header("Location: ../sensor_reply.php?id=".$original_id);
    
?>