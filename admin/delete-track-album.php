<?php
    include_once("includes/checksession.php");
    if(!isset($_GET['q']))
        header("location: track-album.php");
    else
    {
        $id=$_GET['q'];
        include_once("includes/connection.php");
        $con=new MySQL();
        mysql_query("delete from album_media_gallery where id=".$id);
        $con->CloseConnection();
        header("location: track-album.php");
    }
?>