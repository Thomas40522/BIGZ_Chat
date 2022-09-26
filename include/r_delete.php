<?php
    session_start();
    require_once('db.php');


    $id = $_GET['replyid'];
    $postId = $_GET['postid'];

    $newId = "r" .$postId;
    $rel = "SELECT * FROM $newId WHERE id = '".$id."' LIMIT 1";
    $reply = mysqli_query($conn, $rel);
    $reply = mysqli_fetch_assoc($reply);

    if($reply['username'] = $_SESSION['username']){
        echo "<script> alert('it is not your post, please don't intentionally attack our website') </script>";
        echo "<script> window.location.href = 'titlepage.php'; </script>";
    }
    $newId = "r".$postId;
    $sql = "DELETE FROM $newId WHERE id = '" .$id ."' LIMIT 1";
    mysqli_query($conn,$sql);
    
    $pos = "SELECT popularity FROM posts WHERE id = '".$postId."' LIMIT 1";
    $post = mysqli_query($conn, $pos);
    $post = mysqli_fetch_assoc($post);
    $popularity = $post['popularity'] - 10;
    $inc = "UPDATE posts SET popularity='$popularity' WHERE id = '$postId' LIMIT 1";
    mysqli_query($conn, $inc);

    header("Location: ../reply.php?id=".$postId);
    
?>