<?php
    include_once("includes/checksession.php");
    if(!isset($_POST['ids']))
        header("location: feedback.php");
    else
    {
        $ids=$_POST['ids'];
        $reply=$_POST['reply_content'];
        echo $ids;        
        echo "<br />";
        echo $reply;
    }
?>