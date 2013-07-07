<?php
    include_once("includes/checksession.php");
    if(!isset($_GET['q']))
        header("location: feedback.php");
    else
    {
        $id=$_GET['q'];
        include_once("includes/connection.php");
        $con=new MySQL();
        mysql_query("delete from feedback where id=".$id);
        $con->CloseConnection();
        header("location: feedback.php");
    }
?>