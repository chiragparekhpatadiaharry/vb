<?php
    include_once("includes/checksession.php");
    if(!isset($_GET['q']))
        header("location: about-us-content.php");
    else
    {
        $id=$_GET['q'];
        include_once("includes/connection.php");
        $con=new MySQL();
        $rs=mysql_query("select image from about_us_content where id=".$id);
        while($r=mysql_fetch_array($rs))
        {
            unlink("uploads/about-us/original/".$r['image']);
            unlink("uploads/about-us/thumbs/".$r['image']);
        }
        mysql_query("delete from about_us_content where id=".$id);
        $con->CloseConnection();
        header("location: about-us-content.php");
    }
?>