<?php include_once "includes/checksession.php"; ?>
<?php
    if(!isset($_POST['btnSubmit']))
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
                <h5>Update Photo Album</h5>
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
             if(isset($_POST['btnSubmit']))
             {
                if(trim($_POST['txtTrackAlbumName'])!="")
                {
                    include_once "includes/connection.php";
                    $con=new MySQL();
                    $id=$_POST['hidId'];
                    $name=$_POST['txtTrackAlbumName'];
                    $rs=mysql_query("select id,name from album_media_gallery where name like '".$name."'");
                    if(mysql_num_rows($rs)>0)
                    {
                        $r=mysql_fetch_array($rs);
                        if($r['name'] != $name)
                        {
        ?>
                        <div class="nNote nWarning hideit">
                            <p><strong>WARNING: </strong>Album with this name already exists. Specify different name.</p>
                        </div>
        <?php
                        }
                        else
                        {
        ?>
                         <div class="nNote nSuccess hideit">
                            <p><strong>SUCCESS: </strong>Album name updated successfully.</p>
                         </div>   
        <?php
                        }
                    }
                    else if(mysql_query("update album_media_gallery set name='".$name."' where id=".$id))
                    {
        ?>
                         <div class="nNote nSuccess hideit">
                            <p><strong>SUCCESS: </strong>Album name updated successfully.</p>
                         </div>
        <?php
                    }
                    else
                    {
        ?>
                        <div class="nNote nFailure hideit">
                            <p><strong>FAILURE: </strong>Oops sorry. We are unable to update track album. Please try again.</p>
                        </div>
        <?php
                    }
                    $con->CloseConnection();
                }
             }
        ?>
    </div>
    
<?php include_once "includes/footer.php";?>   

</body>
</html>