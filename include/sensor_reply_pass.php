<?php
    require_once('db.php');

    $id = $_GET['id'];
    $replyid = $_GET['replyid'];
    $original_id = $_GET['original_id'];
    $sql="UPDATE $id SET isReported=0 WHERE id = $replyid LIMIT 1";
    if(mysqli_query($conn, $sql)){

    }else{
        die ($replyid);
    };
    header("Location: ../sensor_reply.php?id=".$original_id);
?>