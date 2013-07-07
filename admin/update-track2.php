<?php include_once "includes/checksession.php"; ?>
<?php
    if(!isset($_POST['btnSubmit']))
        header("location: photo.php");
?>
<?php 
    include_once "includes/message.php";
    $msg=new Message(); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />
<title>Update Track</title>

<?php include_once "includes/common-css-js.php";?>

<!-- Shared on MafiaShare.net  --><!-- Shared on MafiaShare.net  --></head>

<body>

<?php include_once "includes/leftside.php";?>



<?php include_once "includes/rightside.php";?>    
    <!-- Title area -->
    <div class="titleArea">
        <div class="wrapper">
            <div class="pageTitle">
                <h5>Update Track</h5>
                <!-- <span>Update photo album.</span> -->
            </div>
            <div class="clear"></div>
        </div>
    </div>
    
    <div class="line"></div>
    
    <!-- Main content wrapper -->
    <div class="wrapper">
        <br />
        <a style="margin: 5px;" class="button blueB" title="" href="track.php">
            <img class="icon" alt="" src="images/icons/light/view.png" />
            <span>View</span>
        </a>
        <a style="margin: 5px;" class="button blueB" title="" href="add-new-track.php">
            <img class="icon" alt="" src="images/icons/light/add.png" />
            <span>Add New</span>
        </a>
        <?php
             if(isset($_POST['btnSubmit']))
             {
                include_once "includes/connection.php";
                $con=new MySQL();
                
                $id=$_POST['hidId'];
                $path=$_POST['hidPath'];
                $album=$_POST['lstAlbum'];
                $trackName=$_POST['txtTrackName'];
                $desc=$_POST['txtDesc'];
                $sec=$_POST['secRadio'];
                
                if(!is_dir("uploads"))
            	{
                    mkdir("uploads");
            	}
                if(!is_dir("uploads/track"))
            	{
                    mkdir("uploads/track");
            	}
                $track_name=$_FILES['fileTrack']['name'];
                $track_tmp_name=$_FILES['fileTrack']['tmp_name'];
                $track_type=$_FILES['fileTrack']['type'];
                $ext= end(explode('.',$track_name));
                $ext='.'.$ext;
                
                $rs=mysql_query("select name from album_media_gallery where id=".$album);
                $r=mysql_fetch_array($rs);
                date_default_timezone_set('Asia/Calcutta');
                $prod_track_path=$r['name'].'_'.str_replace(' ','',$trackName).'_'.date('dmYHis');
                
                $p="uploads/track/".$prod_track_path.$ext;
                
                 if($album!="-1" && trim($trackName)!="" && trim($desc)!="")
                    {
                        $q="";
                        $f=false;
                        if($track_name!="")
                        {
                            if( ($ext==".mp3" || $ext==".wav") )
                            {
                                unlink("uploads/track/".$path);
                                move_uploaded_file($track_tmp_name,"uploads/track/".$prod_track_path.$ext);
                                $q="update track_media_gallery set album_id=$album, name='$trackName', path='".$prod_track_path.$ext."', description='$desc', secure=$sec where id=".$id;
                                $f=true;
                            }
                            else
                                $f=false;
                        }
                        else
                        {
                            $ext= end(explode('.',$path));
                            $ext='.'.$ext;
                            $newpath=$r['name'].'_'.str_replace(' ','',$trackName).'_'.date('dmYHis');
                            rename("uploads/track/".$path,"uploads/track/".$newpath.$ext);
                            $q="update track_media_gallery set album_id=$album, name='$trackName', path='".$newpath.$ext."', description='$desc', secure=$sec where id=".$id;
                            $f=true;
                        }
                        if($f)
                        {
                            if(mysql_query($q))
                                $msg->success("Track updated successfully.");
                            else
                                $msg->error("We are unable to update track. Please try again.");
                        }
                        else
                        {
                             $msg->warning("Select valid track file.");
                        }
                    }
                
                $con->CloseConnection();
             }
        ?>
    </div>
    
<?php include_once "includes/footer.php";?>   

</body>
</html>