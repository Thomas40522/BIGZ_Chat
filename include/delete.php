<?php
    session_start();
    require_once('db.php');

    if (!isset($_GET['username'])){
        header("Location: titlepage.php");
    }

    $username = $_GET['username'];
    $id = $_GET['postid'];
    if($username == $_SESSION['username']){
        $sql = "DELETE FROM posts WHERE id = '" .$id ."' LIMIT 1";
        mysqli_query($conn,$sql);
        $id = "r".$id;
        $table = "DROP TABLE $id";
        if (mysqli_query($conn,$table)){
            header("Location: ../titlepage.php");
        }
    }else{
        echo "<script src='../js/warn.js'></script> <script> warning('this is not your post, you cannot delete it'); 
            window.location.href = '../titlepage.php';
        </script>";
    }
    
?>