<?php
    include_once("includes/checksession.php");
    if(!isset($_GET['q']))
        header("location: photo.php");
    else
    {
        $id=$_GET['q'];
        include_once("includes/connection.php");
        $con=new MySQL();
        $rs=mysql_query("select path from image_photo_gallery where id=".$id);
        while($r=mysql_fetch_array($rs))
        {
            unlink("uploads/original/".$r['path']);
            unlink("uploads/thumbs/".$r['path']);
        }
        mysql_query("delete from image_photo_gallery where id=".$id);
        $con->CloseConnection();
        header("location: photo.php");
    }
?>