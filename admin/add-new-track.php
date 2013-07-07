<?php include_once "includes/checksession.php"; ?>
<?php 
    include_once "includes/message.php";
    $msg=new Message(); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />
<title>Add New Track</title>

<?php include_once "includes/common-css-js.php";?>

<!-- Shared on MafiaShare.net  --><!-- Shared on MafiaShare.net  --></head>

<body>

<?php include_once "includes/leftside.php";?>



<?php include_once "includes/rightside.php";?>    
    <!-- Title area -->
    <div class="titleArea">
        <div class="wrapper">
            <div class="pageTitle">
                <h5>Add New Photo</h5>
                <!--<span>Add new photo album.</span>-->
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
        <?php
             if(isset($_POST['btnSubmit']))
             {
                include_once "includes/connection.php";
                include_once "includes/image.php";
                $con=new MySQL();
                
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
                if(!($ext==".mp3" || $ext==".wav"))
                {
                    $msg->warning("Select valid track file.");
                }
                else
                {
                    if($album!="-1" && trim($trackName)!="" && trim($desc)!="" && $track_name!="" && ($ext==".mp3" || $ext==".wav"))
                    {
                            move_uploaded_file($track_tmp_name,"uploads/track/".$prod_track_path.$ext);
                            if(mysql_query("insert into track_media_gallery(album_id,name,path,description,secure) values($album,'$trackName','".$prod_track_path.$ext."','$desc',$sec)"))
                            {
                                $msg->success("New track saved successfully.");
                            }
                            else
                            {
                                $msg->error("We are unable to save track. Please try again.");
                            }
                    }
                    else
                    {
                        $msg->warning("Please provide all of the fields.");
                    }
                }
                $con->CloseConnection();
             }
             
        ?>
        <form enctype="multipart/form-data" style="margin-top:20px;" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" class="form" id="validate">
        	<fieldset>
                <div class="widget" style="margin-top: 20px;">
                    <div class="title">
                        <img class="titleIcon" alt="" src="images/icons/dark/add.png" />
                        <h6>Add Tack</h6>
                    </div>
                    <div class="formRow">
                        <label>Select Album:&nbsp;<span class="req">*</span></label>
                        <select name="lstAlbum" >
                           <option selected="" value="-1">- - Select - -</option>
                           <?php
                                include_once "includes/connection.php";
                                $con=new MySQL();
                                $rs=mysql_query("select id,name from album_media_gallery");
                                if(mysql_num_rows($rs)>0)
                                {
                                    while($r=mysql_fetch_array($rs))
                                    {
                           ?>
                                        <option value="<?php echo $r['id']; ?>"><?php echo $r['name']; ?></option>
                           <?php
                                    }
                                }
                                $con->CloseConnection();
                           ?>
                        </select>
                        <div class="clear"></div>
                    </div>
                    <div class="formRow">
                        <label>Track Name:&nbsp;<span class="req">*</span></label>
                        <div class="formRight">
                            <input type="text" id="txtTrackName" name="txtTrackName" class="validate[required]" />
                        </div><div class="clear"></div>
                    </div>
                    <div class="formRow">
                        <label>Select File:&nbsp;<span class="req">*</span></label>
                        <div class="formRight">
                            <input type="file" id="fileTrack" name="fileTrack" class="validate[required]" />
                        </div><div class="clear"></div>
                    </div>
                    <div class="formRow">
                        <label>Description:&nbsp;<span class="req">*</span></label>
                        <div class="formRight">
                            <textarea name="txtDesc" id="txtDesc" class="validate[required]" ></textarea>
                        </div><div class="clear"></div>
                    </div>
                    <div class="formRow">
                        <label>Security:&nbsp;<span class="req">*</span></label>
                        <div class="formRight">
                            <input type="radio" id="rdSecAllowDl" value="0" name="secRadio" checked="checked" style="opacity: 0;" /> Allow Download
                            <div class="clear"></div><br />
                            <input type="radio" id="rdSecRestrictDl" value="1" name="secRadio" style="opacity: 0;" /> Restrict Download
                        </div><div class="clear"></div>
                    </div>
                    <div class="formSubmit">
                        <input type="submit" class="redB" name="btnSubmit" value="save" />
                    </div>
                    <div class="clear"></div>
                </div>
            </fieldset>
        </form>
    </div>
    
<?php include_once "includes/footer.php";?>   

</body>
</html>