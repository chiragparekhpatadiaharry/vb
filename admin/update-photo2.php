<?php include_once "includes/checksession.php"; ?>
<?php
    if(!isset($_POST['btnSubmit']))
        header("location: track.php");
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
             if(isset($_POST['btnSubmit']))
             {
                include_once "includes/connection.php";
                include_once "includes/image.php";
                    $con=new MySQL();
                    $id=$_POST['hidId'];
                    $path=$_POST['hidPath'];
                    $album=$_POST['lstAlbum'];
                    $name=$_POST['txtPhotoName'];
                    $desc=$_POST['txtDesc'];
                    
                    if(!is_dir("uploads"))
                	{
                        mkdir("uploads");
                	}
                    if(!is_dir("uploads/thumbs"))
                	{
                        mkdir("uploads/thumbs");
                	}
                    if(!is_dir("uploads/original"))
                	{
                        mkdir("uploads/original");
                	}
                    $img_name=$_FILES['fileImage']['name'];
                    $img_tmp_name=$_FILES['fileImage']['tmp_name'];
                    $img_type=$_FILES['fileImage']['type'];
                    $rs=mysql_query("select name from album_photo_gallery where id=".$album);
                    $r=mysql_fetch_array($rs);
                    date_default_timezone_set('Asia/Calcutta');
                    $prod_img_path=$r['name'].'_'.str_replace(' ','',$name).'_'.date('dmYHis');
                    $ext="";
                    switch($img_type)
                    {
                        case "image/gif":
                            $ext=".gif";
                            break;
                        case "image/bmp":
                            $ext=".bmp";
                            break;
                        case "image/jpeg":
                            $ext=".jpg";
                            break;
                        case "image/png":
                            $ext=".png";
                            break;
                    }
                    
                    $p="uploads/original/".$prod_img_path.$ext;
                    
                    if($album!="-1" && trim($name)!="" && trim($desc)!="")
                    {
                        $q="";
                        if($img_name!="" && ($img_type=="image/gif" or $img_type=="image/bmp" or $img_type=="image/jpeg" or $img_type=="image/png"))
                        {
                            unlink("uploads/original/".$path);
                            unlink("uploads/thumbs/".$path);
                            move_uploaded_file($img_tmp_name,"uploads/original/".$prod_img_path.$ext);
                            $image = new SimpleImage();
                            $image->load($p);
                            $image->resize(150,150);
                            $image->save('uploads/thumbs/'.$prod_img_path.$ext);
                            $q="update image_photo_gallery set album_id=".$album.", name='".$name."', path='".$prod_img_path.$ext."', description='".$desc."' where id=".$id;
                        }
                        else
                        {
                            $ext= end(explode('.',$path));
                            $ext='.'.$ext;
                            $newpath=$r['name'].'_'.str_replace(' ','',$name).'_'.date('dmYHis');
                            rename("uploads/original/".$path,"uploads/original/".$newpath.$ext);
                            rename("uploads/thumbs/".$path,"uploads/thumbs/".$newpath.$ext);
                            $q="update image_photo_gallery set album_id=".$album.", name='".$name."', path='".$newpath.$ext."', description='".$desc."' where id=".$id;
                        }
                        if(mysql_query($q))
                        {
        ?>
                         <div class="nNote nSuccess hideit">
                            <p><strong>SUCCESS: </strong>Photo updated successfully.</p>
                         </div>
        <?php
                        }
                        else
                        {
        ?>
                        <div class="nNote nFailure hideit">
                            <p><strong>FAILURE: </strong>Oops sorry. We are unable to update photo. Please try again.</p>
                        </div>
        <?php
                        }
                    }
                    $con->CloseConnection();
            }
        ?>
    </div>
    
<?php include_once "includes/footer.php";?>   

</body>
</html>