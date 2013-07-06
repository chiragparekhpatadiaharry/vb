<?php
    include_once("includes/checksession.php");
    if(!isset($_GET['q']))
        header("location: about-us-category.php");
    else
    {
        $id=$_GET['q'];
        include_once("includes/connection.php");
        $con=new MySQL();
        mysql_query("delete from about_us_category where id=".$id);
        $con->CloseConnection();
        header("location: about-us-category.php");
    }
?>