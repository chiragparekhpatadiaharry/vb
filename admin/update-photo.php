<?php include_once "includes/checksession.php"; ?>
<?php
    if(!isset($_GET['q']))
        header("location: photo-album.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />
<title>Update Photo</title>

<?php include_once "includes/common-css-js.php";?>

<!-- Shared on MafiaShare.net  --><!-- Shared on MafiaShare.net  --></head>

<body>

<?php include_once "includes/leftside.php";?>



<?php include_once "includes/rightside.php";?>    
    <!-- Title area -->
    <div class="titleArea">
        <div class="wrapper">
            <div class="pageTitle">
                <h5>Update Photo</h5>
                <!-- <span>Update photo album.</span> -->
            </div>
            <div class="clear"></div>
        </div>
    </div>
    
    <div class="line"></div>
    
    <!-- Main content wrapper -->
    <div class="wrapper">
        <br />
        <a style="margin: 5px;" class="button blueB" title="" href="photo.php">
            <img class="icon" alt="" src="images/icons/light/view.png" />
            <span>View</span>
        </a>
        <a style="margin: 5px;" class="button blueB" title="" href="add-new-photo.php">
            <img class="icon" alt="" src="images/icons/light/add.png" />
            <span>Add New</span>
        </a>
        <?php
             if(isset($_GET['q']))
             {
                include_once "includes/connection.php";
                $con=new MySQL();
                $id=$_GET['q'];
                $rs=mysql_query("select * from image_photo_gallery where id=".$id);
                $r=mysql_fetch_array($rs);
                $con->CloseConnection();
             }
        ?>
        <form enctype="multipart/form-data" style="margin-top:20px;" action="update-photo2.php" method="post" class="form" id="validate">
            <input type="hidden" name="hidId" value="<?php echo $r['id']; ?>" />
        	<fieldset>
                <div class="widget" style="margin-top: 20px;">
                    <div class="title">
                        <img class="titleIcon" alt="" src="images/icons/dark/pencil.png" />
                        <h6>Update Photo</h6>
                    </div>
                    <div class="formRow">
                        <label>Select Album:</label>
                        <select name="lstAlbum">
                           <option selected="" value="-1">- - Select - -</option>
                           <?php
                                include_once "includes/connection.php";
                                $con=new MySQL();
                                $rs2=mysql_query("select id,name from album_photo_gallery");
                                if(mysql_num_rows($rs2)>0)
                                {
                                    while($r2=mysql_fetch_array($rs2))
                                    {
                           ?>
                                        <option <?php echo ($r['album_id']==$r2['id'])?"selected=\"\"":""; ?> value="<?php echo $r2['id']; ?>"><?php echo $r2['name']; ?></option>
                           <?php
                                    }
                                }
                                $con->CloseConnection();
                           ?>
                        </select>
                        <div class="clear"></div>
                    </div>
                    <div class="formRow">
                        <label>Photo Name:&nbsp;<span class="req">*</span></label>
                        <div class="formRight">
                            <input type="text" value="<?php echo $r['name'];?>" id="txtPhotoName" name="txtPhotoName" class="validate[required]" />
                        </div><div class="clear"></div>
                    </div>
                    <div class="formRow">
                        <input type="hidden" name="hidPath" value="<?php echo $r['path']; ?>" />
                        <a style="float: left;margin-right: 20px;" rel="lightbox" title="" href="uploads/original/<?php echo $r["path"]; ?>">
                            <img style="height: 60px;width: 60px;border:2px solid #cecece" alt="" src="uploads/thumbs/<?php echo $r["path"]; ?>" />
                        </a>
                        <label>Change Image:</label>
                        <div class="formRight">
                            <input type="file" id="fileImage" name="fileImage" /><br />
                        </div><div class="clear"></div>
                    </div>
                    <div class="formRow">
                        <label>Description:&nbsp;<span class="req">*</span></label>
                        <div class="formRight">
                            <textarea name="txtDesc" id="txtDesc" class="validate[required]" ><?php echo $r['description'];?></textarea>
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