<?php
    include_once("includes/checksession.php");
    if(!isset($_GET['q']))
        header("location: track.php");
    else
    {
        $id=$_GET['q'];
        include_once("includes/connection.php");
        $con=new MySQL();
        $rs=mysql_query("select path from track_media_gallery where id=".$id);
        while($r=mysql_fetch_array($rs))
        {
            unlink("uploads/track/".$r['path']);
        }
        mysql_query("delete from track_media_gallery where id=".$id);
        $con->CloseConnection();
        header("location: track.php");
    }
?>