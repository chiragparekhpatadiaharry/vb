<?php include_once "includes/checksession.php"; ?>
<?php
    if(!isset($_GET['q']))
        header("location: track-album.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />
<title>Update Track Album</title>

<?php include_once "includes/common-css-js.php";?>

<!-- Shared on MafiaShare.net  --><!-- Shared on MafiaShare.net  --></head>

<body>

<?php include_once "includes/leftside.php";?>



<?php include_once "includes/rightside.php";?>    
    <!-- Title area -->
    <div class="titleArea">
        <div class="wrapper">
            <div class="pageTitle">
                <h5>Update Track Album</h5>
                <!-- <span>Update photo album.</span> -->
            </div>
            <div class="clear"></div>
        </div>
    </div>
    
    <div class="line"></div>
    
    <!-- Main content wrapper -->
    <div class="wrapper">
        <br />
        <a style="margin: 5px;" class="button blueB" title="" href="track-album.php">
            <img class="icon" alt="" src="images/icons/light/view.png" />
            <span>View</span>
        </a>
        <a style="margin: 5px;" class="button blueB" title="" href="add-new-track-album.php">
            <img class="icon" alt="" src="images/icons/light/add.png" />
            <span>Add New</span>
        </a>
        <?php
             if(isset($_GET['q']))
             {
                include_once "includes/connection.php";
                $con=new MySQL();
                $id=$_GET['q'];
                $rs=mysql_query("select * from album_media_gallery where id=".$id);
                $r=mysql_fetch_array($rs);
                $con->CloseConnection();
             }
        ?>
        <form  style="margin-top:20px;" action="update-track-album2.php" method="post" class="form" id="validate">
            <input type="hidden" name="hidId" value="<?php echo $r['id']; ?>" />
        	<fieldset>
                <div class="widget" style="margin-top: 20px;">
                    <div class="title">
                        <img class="titleIcon" alt="" src="images/icons/dark/pencil.png" />
                        <h6>Update Track Album</h6>
                    </div>
                    <div class="formRow">
                        <label>Album Name:&nbsp;<span class="req">*</span></label>
                        <div class="formRight">
                            <input type="text" value="<?php echo $r['name']; ?>" id="txtTrackAlbumName" name="txtTrackAlbumName" class="validate[required]" />
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