<?php
    session_start();
    require_once('db.php');

    $id = $_GET['id'];
    $sql = "DELETE FROM suggestions WHERE id = '" .$id ."' LIMIT 1";
    if (mysqli_query($conn,$sql)){
        header("Location: ../admin_box.php");
    }else{
        echo mysqli_error($conn);
    }
    
?>