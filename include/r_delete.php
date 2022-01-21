<?php
    session_start();
    require_once('db.php');

    if (!isset($_GET['username'])){
        header("Location: titlepage.php");
    }

    $username = $_GET['username'];
    $id = $_GET['replyid'];
    $postId = $_GET['postid'];
    $newId = "r".$postId;
    if($username == $_SESSION['username']){
        $sql = "DELETE FROM $newId WHERE id = '" .$id ."' LIMIT 1";
        mysqli_query($conn,$sql);
        header("Location: ../reply.php?id=".$postId);
    }else{
        header("Location: ../reply.php?id=".$postId);
    }
    
?>